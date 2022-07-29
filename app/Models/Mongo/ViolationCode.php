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

    public $perPage = self::PER_PAGE;
    public $sortField= self::SORT_BY_FIELD;
    public $sortValue = self::SORT_VALUE;

    protected $fillable = [
        'name',
        'type_id'
    ];

    public function violationType()
    {
        return $this->belongsTo(ViolationType::class, 'type_id', '_id');
    }

    public function analize($params, $shouldPaginate = true) {
        // Custom query
        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $total = self::count();
        $aggregateQuery = [];

        $violationPageMatchConditions = [
            [ '$eq'=> [ '$status',  Article::STATUS_VIOLATION ] ],
            [ '$eq'=> [ '$articleCodeArr.id',  '$$code_id' ] ],
        ];

        $autoPageMatchConditions = [
            [ '$eq'=> [ '$status',  Article::STATUS_PENDING ] ],
            [ '$eq'=> [ '$detection_type',  Article::DETECTION_TYPE_BOT ] ],
            [ '$eq'=> [ '$articleCodeArr.id',  '$$code_id' ] ],
        ];

        $manualPageMatchConditions = [
            [ '$eq'=> [ '$status',  Article::STATUS_PENDING ] ],
            [ '$eq'=> [ '$detection_type',  Article::DETECTION_TYPE_MANUAL ] ],
            [ '$eq'=> [ '$articleCodeArr.id',  '$$code_id' ] ],
        ];

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date'].' 00:00:00');
            $endDate = strtotime($params['end_date'].' 23:59:59');

            $violationPageMatchConditions[] = [ '$gte' => [ '$operator_review.review_date',  $startDate ] ];
            $violationPageMatchConditions[] = [ '$lte' => [ '$operator_review.review_date',  $endDate ] ];

            $autoPageMatchConditions[] = [ '$gte' => [ '$published_date',  $startDate ] ];
            $autoPageMatchConditions[] = [ '$lte' => [ '$published_date',  $endDate ] ];

            $manualPageMatchConditions[] = [ '$gte' => [ '$detection_result.crawl_date',  $startDate ] ];
            $manualPageMatchConditions[] = [ '$lte' => [ '$detection_result.crawl_date',  $endDate ] ];
        }

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'violation_articles_by_code',
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
                                '$and' => $violationPageMatchConditions
                            ]
                        ]
                    ],
                    ['$project' => ['_id' => 1]]
                ]
            ]
        ];

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'auto_articles_by_code',
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
                                '$and' => $autoPageMatchConditions
                            ]
                        ]
                    ],
                    ['$project' => ['_id' => 1]]
                ]
            ]
        ];

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'manual_articles_by_code',
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
                                '$and' => $manualPageMatchConditions
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
                            '_id' => 1, 'name' => 1, 'color' => 1
                        ]
                    ]
                ]
            ]
        ];
        $aggregateQuery[] = [
            '$addFields' => [
                'total_article' => ['$sum' => [['$size' => '$violation_articles_by_code'], ['$size' => '$auto_articles_by_code'], ['$size' => '$manual_articles_by_code']]],
                'violation_type' => [ '$first' => '$violation_types']
            ]
        ];

        if(isset($params['perpage'])) {
            $this->perPage = intval($params['perpage']);
        }

        $aggregateQuery[] = [
            '$project' => [
                '_id' => 1,
                'name' => 1,
                'total_article' => 1,
                'type_name' => '$violation_type.name',
                'type_color' => '$violation_type.color'
            ]
        ];

        if(isset($params['sort_by'])) {
            $this->sortField = $params['sort_by'];
        }
        if(isset($params['sort_value'])) {
            $this->sortValue = strtoupper($params['sort_value']) === 'DESC' ? -1 : 1;
        }

        $aggregateQuery[] = [
            '$sort' => [ $this->sortField => $this->sortValue ]
        ];

        if($shouldPaginate) {
            $aggregateQuery[] = ['$skip' => ($page - 1) * $this->perPage];
            $aggregateQuery[] = ['$limit' => $this->perPage];
        }
        // dd($aggregateQuery);
        $collection = self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });

        return new \Illuminate\Pagination\LengthAwarePaginator($collection, $total, $this->perPage, $page, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
        ]);
    }
}
