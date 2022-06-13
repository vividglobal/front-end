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

    public $perPage;
    public $sortField;
    public $sortValue;

    protected $fillable = [
        'name',
        'type',
        'parent_id'
    ];

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
        if(isset($params['brand_id'])) {
            $aggregateQuery[] = ['$match' => ['_id' => ['$toObjectId' => $params['brand_id'] ]] ];
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
                            [ '$and'=>
                                [
                                    [ '$or' => [
                                        [ '$eq'=> [ '$brand.id',  '$$company_brand_id' ] ],
                                        [ '$eq'=> [ '$company.id',  '$$company_brand_id' ] ],
                                    ]]
                                ]
                            ]
                        ]
                    ],
                    ['$project' => ['_id' => 1]]
                ]
            ]
        ];

        // Lookup : total violation articles
        $violationArticleMatch = [
            [ '$eq'=> [ '$status',  Article::STATUS_VIOLATION ] ],
            [ '$or' => [
                [ '$eq'=> [ '$brand.id',  '$$company_brand_id' ] ],
                [ '$eq'=> [ '$company.id',  '$$company_brand_id' ] ],
            ]]
        ];
        if(isset($params['country_id'])) {
            $violationArticleMatch[] = [ '$eq'=> [ '$company.id', $params['country_id'] ] ];
        }
        if(isset($params['violation_type_id'])) {
            $violationArticleMatch[] = [ '$eq'=> [ '$operator_review.violation_types.id', $params['violation_type_id'] ] ];
        }
        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'violation_articles_by_brand',
                'from' => 'articles',
                'let' => [ 'company_brand_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [ '$match'=>
                        [
                            '$expr'=> [ '$and'=> $violationArticleMatch ]
                        ]
                    ]
                ]
            ]
        ];
        $aggregateQuery[] = [
            '$addFields' => [
                'total_article' => ['$size' => '$articles_by_brand'],
                'total_violation_article' => ['$size' => '$violation_articles_by_brand']
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
                'total_article' => 1, 'total_violation_article' => 1,
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
