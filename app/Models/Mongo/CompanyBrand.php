<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Mongo\Article;

class CompanyBrand extends Model
{
    protected $collection = 'company_brands';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    const PER_PAGE = 10;
    const SORT_BY_FIELD = 'percent_violation_per_article';
    const SORT_VALUE = -1; // - 1 :DESC , 1 : ASC

    const TYPE_COMPANY = 'COMPANY';
    const TYPE_BRAND = 'BRAND';

    public $perPage = self::PER_PAGE;
    public $sortField = self::SORT_BY_FIELD;
    public $sortValue = self::SORT_VALUE;

    protected $fillable = [
        'name',
        'type',
        'parent_id'
    ];

    protected $attributes = [
        'parent_id' => null
    ];

    public function generalQuery($params) {
        $aggregateQuery = [];
        if(isset($params['brand_id'])) {
            $aggregateQuery[] = [
                '$match' => [
                    '$expr'=> [ '$and'=> [
                        [ '$eq'=> [ '$_id',  ['$toObjectId' => $params['brand_id'] ] ] ],
                    ] ]
                ]
            ];
        }

        $matchConditions = [
            [ '$or' => [
                [ '$eq'=> [ '$brand.id',  '$$company_brand_id' ] ],
                [ '$eq'=> [ '$company.id',  '$$company_brand_id' ] ],
            ]]
        ];

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date']);
            $endDate = strtotime($params['end_date']);
            $matchConditions[] = [ '$and'=> [
                [
                    [ '$gte'=> [ '$operator_review.date',  $startDate ] ],
                    [ '$lte'=> [ '$operator_review.date',  $endDate ] ],
                ]
            ] ];
        }

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'articles_by_brand',
                'from' => 'articles',
                'let' => [ 'company_brand_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [ '$match'=>
                        [
                            '$expr'=>
                            [ '$and'=> $matchConditions ]
                        ]
                    ],
                    ['$project' => ['_id' => 1]]
                ]
            ]
        ];

        // Lookup : total violation articles
        $violationArticleMatch = $matchConditions;
        $violationArticleMatch[] = [ '$eq'=> [ '$status',  Article::STATUS_VIOLATION ] ];

        if(isset($params['country_id'])) {
            $violationArticleMatch[] = [ '$eq'=> [ '$country.id', $params['country_id'] ] ];
        }
        
        $violationArticlePipeLine = [
            [ '$match'=>
                [
                    '$expr'=> [ '$and'=> $violationArticleMatch ]
                ]
            ]
        ];

        if(isset($params['violation_type_id'])) {
            $violationArticlePipeLine[] = [
                '$match' =>
                [
                    'operator_review.violation_types' => [
                        '$elemMatch' => [
                            'id' => $params['violation_type_id']
                        ]
                    ]
                ]
            ];
        }
        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'violation_articles_by_brand',
                'from' => 'articles',
                'let' => [ 'company_brand_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => $violationArticlePipeLine
            ]
        ];

        return $aggregateQuery;
    }

    public function aggregateCount($params) {
        $aggregateQuery = $this->generalQuery($params);
        $aggregateQuery[] = [
            '$project' => ['_id' => 1]
        ];
        $collection = self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });
        return count($collection);
    }

    public function analize($params, $shouldPaginate = true) {
        // Custom query
        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $total = $this->aggregateCount($params);
        $aggregateQuery = $this->generalQuery($params);

        $aggregateQuery[] = [
            '$addFields' => [
                'total_article' => ['$size' => '$articles_by_brand'],
                'total_violation_article' => ['$size' => '$violation_articles_by_brand'],
            ]
        ];

        $aggregateQuery[] = [
            '$project' => [
                '_id' => 1,
                'name' => 1,
                'queryId' => 1,
                'total_article' => 1,
                'total_violation_article' => 1,
                'percent_violation_per_article' => [
                    '$cond' => [
                        'if' =>  [ '$gt' => [ '$total_violation_article', 0 ] ],
                        'then' => [
                            '$round' => [
                                ['$multiply' => [ ['$divide' => [ '$total_violation_article', '$total_article' ] ] , 100 ]],
                                2
                            ]
                        ],
                        'else' => [ '$toInt' => "0" ]
                    ],
                ]
            ]
        ];

        if(isset($params['perpage'])) {
            $this->perPage = intval($params['perpage']);
        }

        if(isset($params['sort_by'])) {
            $this->sortField = $params['sort_by'];
        }
        if(isset($params['sort_value'])) {
            $this->sortValue = strtoupper($params['sort_value']) === 'DESC' ? -1 : 1;
        }
        $aggregateQuery[] = [
            '$sort' => [$this->sortField => $this->sortValue]
        ];

        if($shouldPaginate) {
            $aggregateQuery[] = ['$skip' => ($page - 1) * $this->perPage];
            $aggregateQuery[] = ['$limit' => $this->perPage];
        }

        $collection = self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });

        return new \Illuminate\Pagination\LengthAwarePaginator($collection, $total, $this->perPage, $page, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
        ]);
    }
}
