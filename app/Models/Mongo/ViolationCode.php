<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Mongo\Article;

class ViolationCode extends Model
{
    protected $collection = 'violation_code';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    const PER_PAGE = 10;
    const SORT_BY_FIELD = 'total_article';
    const SORT_VALUE = -1; // - 1 :DESC , 1 : ASC

    protected $fillable = [
        'name',
        'type_id'
    ];

    public function violationType()
    {
        return $this->belongsTo(ViolationType::class, 'type_id', '_id');
    }

    function __construct() {
        $this->perPage = self::PER_PAGE;
        $this->sortField = self::SORT_BY_FIELD;
        $this->sortValue = self::SORT_VALUE;
    }

    public function analize($params, $shouldPaginate = true) {
        // Custom query
        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $total = self::count();
        $aggregateQuery = [];

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'articles_by_code',
                'from' => 'articles',
                'let' => [ 'code_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [
                        '$addFields' => ['articleCodeArr' => '$operator_review.violation_code' ]
                    ],
                    [
                        '$unwind' => '$articleCodeArr'
                    ],
                    [ '$match'=>
                        [
                            '$expr' => [
                                '$and' => [
                                    [ '$eq'=> [ '$status',  Article::STATUS_VIOLATION ] ],
                                    [ '$eq'=> [ '$articleCodeArr.id',  '$$code_id' ] ],
                                ]
                            ]
                        ]
                    ],
                    ['$project' => ['_id' => 1]]
                ]
            ]
        ];

        // Violation type
        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'violation_types',
                'from' => 'violation_types',
                'let' => [ 'type_id'=> ['$toObjectId'=> '$type_id'] ],
                'pipeline' => [
                    [ '$match'=>
                        [
                            '$expr' => [ '$and'=> [
                                [ '$eq'=> [ '$_id',  '$$type_id' ] ]
                            ] ]
                        ]
                    ],
                    [
                        '$project' => [
                            '_id' => 1, 'name' => 1
                        ]
                    ]
                ]
            ]
        ];
        $aggregateQuery[] = [
            '$addFields' => [
                'total_article' => ['$size' => '$articles_by_code'],
                'violation_type' => [ '$first' => '$violation_types']
            ]
        ];

        if(isset($params['perpage'])) {
            $this->perPage = $params['perpage'];
        }

        if($shouldPaginate) {
            $aggregateQuery[] = ['$skip' => ($page - 1) * $this->perPage];
            $aggregateQuery[] = ['$limit' => $this->perPage];
        }

        $aggregateQuery[] = [
            '$project' => [
                '_id' => 1, 'name' => 1,
                'total_article' => 1, 'type_name' => '$violation_type.name'
            ]
        ];

        if(isset($params['sort_by'])) {
            $this->sortField = $params['sort_by'];
        }
        if(isset($params['sort_value'])) {
            $this->sortValue = $params['sort_value'];
        }

        $aggregateQuery[] = [
            '$sort' => [$this->sortField => $this->sortValue] 
        ];

        $collection = self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });

        return new \Illuminate\Pagination\LengthAwarePaginator($collection, $total, $this->perPage, $page, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
        ]);
    }
}
