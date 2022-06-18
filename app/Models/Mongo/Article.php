<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $collection = 'articles';

    const PER_PAGE = 10;
    const SORT_BY_FIELD = 'detection_result.date';
    const SORT_VALUE = -1;

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    const STATUS_PENDING = 'PENDING';
    const STATUS_VIOLATION = 'VIOLATION';
    const STATUS_NONE_VIOLATION = 'NON_VIOLATION';

    const PROGRESS_NOT_STARTED = 'NOT_STARTED';
    const PROGRESS_PROCESSING = 'PROCESSING';
    const PROGRESS_COMPLETED = 'COMPLETED';

    const DETECTION_TYPE_BOT = 'BOT';
    const DETECTION_TYPE_MANUAL = 'MANUAL';

    const STATUS_REVIEW_PENDING = 'PENDING';
    const STATUS_REVIEW_DONE = 'DONE';

    const AGREE_VIOLATION = 'AGREE';
    const DISAGREE_VIOLATION = 'DISAGREE';

    const ACTION_CHECK_STATUS = 'CHECK_STATUS';
    const ACTION_CHECK_CODE = 'CHECK_CODE';

    const DEFAULT_REVIEW_STATES = [
        'violation_code' => [],
        'violation_types' => [],
        'status' => self::STATUS_REVIEW_PENDING,
        'review_date' => null
    ];

    protected $fillable = [
        'company',
        'country',
        'brand',
        'caption',
        'image',
        'published_date',
        'link',
        'detection_result',
        'supervisor_review',
        'operator_review',
        'status',
        'progress_status',
        'detection_type'
    ];

    protected $attributes = [
        'company' => [],
        'country' => [],
        'brand'   => [],
        'detection_result' => [
            'violation_code' => [],
            'violation_types' => [],
            'status' => self::STATUS_NONE_VIOLATION,
            'crawl_date' => null
        ],
        'supervisor_review' => self::DEFAULT_REVIEW_STATES,
        'operator_review' => self::DEFAULT_REVIEW_STATES,
    ];

    public function aggregateQuery($params) {
        $matchConditions = [];

        if(isset($params['status'])) {
            $matchConditions[] = [ '$eq' => [ '$status',  $params['status'] ] ];
        }

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date']);
            $endDate = strtotime($params['end_date']);
            $matchConditions[] = [ '$gte' => [ '$detection_result.crawl_date',  $startDate ] ];
            $matchConditions[] = [ '$lte' => [ '$detection_result.crawl_date',  $endDate ] ];
        }

        if(isset($params['country'])) {
            $matchConditions[] = [ '$eq' => [ '$country.id',  $params['country'] ] ];
        }

        if(isset($params['company_brand_id'])) {
            $brandId = $params['company_brand_id'];
            $matchConditions[] = [ '$or' => [
                [ '$eq'=> [ '$brand.id',  $brandId ] ],
                [ '$eq'=> [ '$company.id', $brandId ] ]
            ]];
        }

        $aggregateQuery = [
            [ '$match'=>
                [
                    '$expr'=> [ '$and'=> $matchConditions ]
                ]
            ]
        ];

        $aggregateQuery[] = [
            '$lookup' => [
                'as' => 'documents',
                'from' => 'article_legal_documents',
                'let' => [ 'article_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [ '$match' =>
                        [
                            '$expr'=> [ '$and'=> [ '$eq' => [ '$article_id', '$$article_id' ] ] ]
                        ]
                    ],
                    ['$project' => ['_id' => 1, 'name' => 1, 'url' => 1]]
                ]
            ]
        ];

        $aggregateQuery[] = [
            '$addFields' => [
                'company_name'      => '$company.name',
                'brand_name'        => '$brand.name',
                'country_name'      => '$country.name',
                'crawl_date'        => '$detection_result.date',
                'bot_status'        => '$detection_result.status',
                'supervisor_status' => '$supervisor_review.status',
                'operator_status'   => '$operator_review.status',
                'has_document'      => [
                    '$cond' => [
                        'if' =>  [ '$gt' => [ ['$size' => '$documents'] , 0 ] ],
                        'then' => true,
                        'else' => false
                    ]
                ]
            ]
        ];

        if(isset($params['violation_type_id'])) {
            $aggregateQuery[] = [
                '$match' =>
                [
                    'detection_result.violation_types' => [
                        '$elemMatch' => [
                            'id' => $params['violation_type_id']
                        ]
                    ]
                ]
            ];
        }

        if(isset($params['keyword'])) {
            $pattern = preg_quote($params['keyword'], "/");
            $keywordRegex = [ '$regex' => $pattern ];
            $aggregateQuery[] = [
                '$match' =>
                [
                    '$or'=> [
                        [ 'company_name' => $keywordRegex ],
                        [ 'brand_name' => $keywordRegex ],
                        [ 'country_name' => $keywordRegex ],
                        [ 'caption' => $keywordRegex ],
                        [ 'violation_types.name' => $keywordRegex ],
                    ]
                ]
            ];
        }

        return $aggregateQuery;
    }

    public function aggregateCount($params) {
        $aggregateQuery = $this->aggregateQuery($params);
        $aggregateQuery[] = [
            '$project' => ['_id' => 1] 
        ];
        $collection = self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });
        return count($collection);
    }

    public function getList($params, $perpage = self::PER_PAGE, $sortField = self::SORT_BY_FIELD, $sortValue = self::SORT_VALUE) {
        // Custom query
        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $total = $this->aggregateCount($params);

        $aggregateQuery = $this->aggregateQuery($params);

        if(isset($params['perpage'])) {
            $perpage = intval($params['perpage']);
        }

        $aggregateQuery[] = ['$skip' => ($page - 1) * $perpage];
        $aggregateQuery[] = ['$limit' => $perpage];

        if(isset($params['sort_by'])) {
            $sortField = $params['sort_by'];
        }

        if(isset($params['sort_value'])) {
            $sortValue = $params['sort_value'] === 'DESC' ? -1 : 1;
        }

        $aggregateQuery[] = [
            '$sort' => [$sortField => $sortValue] 
        ];

        $collection = self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });

        return new \Illuminate\Pagination\LengthAwarePaginator($collection, $total, $perpage, $page, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
        ]);
    }

    public function getListCount($params) {
        $count = $this->aggregateCount($params);
        return $count;
    }
}
