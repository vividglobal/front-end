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

        $matchConditions = [];

        $matchConditions[] = [ '$or' => [
            [ '$eq'=> [ '$brand.id',  '$$company_brand_id' ] ],
            [ '$eq'=> [ '$company.id',  '$$company_brand_id' ] ],
        ]];



        if(isset($params['country_id'])) {
            $matchConditions[] = [ '$eq'=> [ '$country.id' ,  $params['country_id'] ] ];
        }

        $matchViolationType = [
            '$match' =>
            [
                'status' =>  Article::STATUS_PENDING
            ]
        ];
        if(isset($params['violation_type_id'])) {
            $matchViolationType['$match']['detection_result.violation_types'] = [
                '$elemMatch' => [
                    'id' => $params['violation_type_id']
                ]
            ];
        }

        $matchAutoPageCondtions = $matchManualPageConditions = $matchViolationPageCondtions = $matchNonViolationPageCondtions = $matchConditions;

        $matchAutoPageCondtions[] = [ '$eq' => [ '$detection_type',  Article::DETECTION_TYPE_BOT ] ];
        $matchManualPageConditions[] = [ '$eq' => [ '$detection_type',  Article::DETECTION_TYPE_MANUAL ] ];
        $matchViolationPageCondtions[] = [ '$eq' => [ '$status',  Article::STATUS_VIOLATION ] ];
        $matchNonViolationPageCondtions[] = [ '$eq' => [ '$status',  Article::STATUS_NONE_VIOLATION ] ];

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date'].' 00:00:00');
            $endDate = strtotime($params['end_date'].' 23:59:59');

            $matchAutoPageCondtions[] = [ '$gte' => [ '$published_date',  $startDate ] ];
            $matchAutoPageCondtions[] = [ '$lte' => [ '$published_date',  $endDate ] ];

            $matchManualPageConditions[] = [ '$gte' => [ '$detection_result.crawl_date',  $startDate ] ];
            $matchManualPageConditions[] = [ '$lte' => [ '$detection_result.crawl_date',  $endDate ] ];

            $matchViolationPageCondtions[] = [ '$gte' => [ '$operator_review.review_date',  $startDate ] ];
            $matchViolationPageCondtions[] = [ '$lte' => [ '$operator_review.review_date',  $endDate ] ];

            $matchNonViolationPageCondtions[] = [ '$gte' => [ '$operator_review.review_date',  $startDate ] ];
            $matchNonViolationPageCondtions[] = [ '$lte' => [ '$operator_review.review_date',  $endDate ] ];
        }


        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'auto_articles_by_brand',
                'from' => 'articles',
                'let' => [ 'company_brand_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [ '$match'=>
                        [
                            '$expr'=> [ '$and'=> $matchAutoPageCondtions ]
                        ]
                    ],
                    $matchViolationType,
                    [
                        '$addFields' => [
                            'status' => [
                                '$cond' => [
                                    'if' =>  [ '$gt' => [ ['$size' => '$detection_result.violation_code' ], 0 ] ],
                                    'then' => Article::STATUS_VIOLATION,
                                    'else' => Article::STATUS_NONE_VIOLATION
                                ],
                            ]
                        ]
                    ],
                    ['$project' => [
                        '_id' => 1,
                        'status' => 1
                    ]]
                ]
            ]
        ];

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'manual_articles_by_brand',
                'from' => 'articles',
                'let' => [ 'company_brand_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [ '$match'=>
                        [
                            '$expr' => [ '$and'=> $matchManualPageConditions ]
                        ]
                    ],
                    $matchViolationType,
                    [
                        '$addFields' => [
                            'status' => [
                                '$cond' => [
                                    'if' =>  [ '$gt' => [ ['$size' => '$detection_result.violation_code' ], 0 ] ],
                                    'then' => Article::STATUS_VIOLATION,
                                    'else' => Article::STATUS_NONE_VIOLATION
                                ],
                            ]
                        ]
                    ],
                    ['$project' => [
                        '_id' => 1,
                        'status' => 1
                    ]]
                ]
            ]
        ];

        $violationArticlesPipeline = [];

        $violationArticlesPipeline[] = [ '$match' =>
            [
                '$expr' => [ '$and'=> $matchViolationPageCondtions ]
            ]
        ];

        if(isset($params['violation_type_id'])) {
            $violationArticlesPipeline[] = [
                '$match' => [
                    'detection_result.violation_types' => [
                        '$elemMatch' => [
                            'id' => $params['violation_type_id']
                        ]
                    ]
                ]
            ];
        }

        $violationArticlesPipeline[] = ['$project' => [
            '_id' => 1,
            'status' => 1
        ]];

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'violation_articles_by_brand',
                'from' => 'articles',
                'let' => [ 'company_brand_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => $violationArticlesPipeline
            ]
        ];

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'non_violation_articles_by_brand',
                'from' => 'articles',
                'let' => [ 'company_brand_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [ '$match'=>
                        [
                            '$expr' => [ '$and'=> $matchNonViolationPageCondtions ]
                        ]
                    ],
                    ['$project' => [
                        '_id' => 1,
                        'status' => 1
                    ]]
                ]
            ]
        ];

        // dd($aggregateQuery);
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
                'total_article' => [
                    '$sum' => [
                        ['$size' => '$auto_articles_by_brand'],
                        ['$size' => '$violation_articles_by_brand'],
                        ['$size' => '$non_violation_articles_by_brand'],
                        ['$size' => '$manual_articles_by_brand']
                    ]
                ],
                'violation_from_auto' => [
                    '$size' => [
                        '$filter' => [
                            'input' => '$auto_articles_by_brand',
                            'as'    => 'auto_articles',
                            'cond'  => [
                                '$eq' => ['$$auto_articles.status', Article::STATUS_VIOLATION]
                            ]
                        ]
                    ]
                ],
                'violation_from_manual' => [
                    '$size' => [
                        '$filter' => [
                            'input' => '$manual_articles_by_brand',
                            'as'    => 'manual_articles',
                            'cond'  => [
                                '$eq' => ['$$manual_articles.status', Article::STATUS_VIOLATION]
                            ]
                        ]
                    ]
                ],
                
            ]
        ];

        $aggregateQuery[] = [
            '$addFields' => [
                'total_violation_article' => ['$sum' => ['$violation_from_manual', '$violation_from_auto']]
            ]
        ];

        $aggregateQuery[] = [
            '$project' => [
                '_id' => 1,
                'name' => 1,
                'queryId' => 1,
                'auto_articles_by_brand' => 1,
                'manual_articles_by_brand' => 1,
                'violation_articles_by_brand' => 1,
                'non_violation_articles_by_brand' => 1,
                'total_article' => 1,
                'violation_from_auto' => 1,
                'violation_from_manual' => 1,
                'total_violation_article' => 1,
                'percent_violation_per_article' => [
                    '$cond' => [
                        'if' =>  [
                            '$and' => [
                                [ '$gt' => [ '$total_violation_article', 0 ] ],
                                [ '$gt' => [ '$total_article', 0 ] ]
                            ]
                        ],
                        'then' => [
                            '$round' => [
                                ['$multiply' => [ ['$divide' => [ '$total_violation_article', '$total_article' ] ] , 100 ]],
                                2
                            ]
                        ],
                        'else' => [ '$toInt' => "0" ]
                    ],
                ],
                
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
            '$sort' => [$this->sortField => $this->sortValue, '_id' => -1]
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
