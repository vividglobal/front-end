<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\Regex;
use App\Http\Services\UserRoleService;

class Article extends Model
{
    use HasFactory;

    protected $collection = 'articles';

    const PER_PAGE = 25;
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

    public $perpage = self::PER_PAGE;
    public $sortField = self::SORT_BY_FIELD;
    public $sortValue = self::SORT_VALUE;

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
        $dateField = 'published_date';
        $violationReviewField = 'detection_result';
        $isSupervisor = UserRoleService::isSupervisor();
        $isOperator = UserRoleService::isOperator();

        if(isset($params['status'])) {
            $status = $params['status'];
            $matchConditions[] = [ '$eq' => [ '$status',  $params['status'] ] ];
            if($status === self::STATUS_NONE_VIOLATION || $status === self::STATUS_VIOLATION) {
                $violationReviewField = 'operator_review';
            }
        }

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date'].' 00:00:00');
            $endDate = strtotime($params['end_date'].' 23:59:59');
            $matchConditions[] = [ '$gte' => [ '$published_date',  $startDate ] ];
            $matchConditions[] = [ '$lte' => [ '$published_date',  $endDate ] ];
        }

        if(isset($params['country'])) {
            $matchConditions[] = [ '$eq' => [ '$country.id',  $params['country'] ] ];
        }

        if(isset($params['company_brand_id'])) {
            $brandId = $params['company_brand_id'];
            $matchConditions[] = [ '$or' => [
                [ '$eq' => [ '$brand.id',  $brandId ] ],
                [ '$eq' => [ '$company.id', $brandId ] ]
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
                'as'   => 'documents',
                'from' => 'article_legal_documents',
                'let'  => [ 'article_id'=> ['$toString'=> '$_id'] ],
                'pipeline' => [
                    [ '$match' =>
                        [
                            '$expr'=> [ '$and'=> [ '$eq' => [ '$article_id', '$$article_id' ] ] ]
                        ]
                    ],
                    ['$addFields' => ['upload_date' => ['$toLong' => '$created_at']] ],
                    ['$sort'      => ['created_at' => -1]],
                    ['$project'   => ['_id' => 1, 'name' => 1, 'url' => 1, 'upload_date' => 1 ]]
                ]
            ]
        ];

        $aggregateQuery[] = [
            '$addFields' => [
                'bot_type_ids'            => '$detection_result.violation_types.id',
                'bot_type_names'          => '$detection_result.violation_types.name',
                'bot_code_names'          => '$detection_result.violation_code.name',
                'supervisor_type_ids'     => '$supervisor_review.violation_types.id',
                'supervisor_type_names'   => '$supervisor_review.violation_types.name',
                'supervisor_code_names'   => '$supervisor_review.violation_code.name',
                'operator_type_ids'       => '$operator_review.violation_types.id',
                'operator_type_names'     => '$operator_review.violation_types.name',
                'operator_code_names'     => '$operator_review.violation_code.name',
                'company_name'            => '$company.name',
                'brand_name'              => '$brand.name',
                'country_name'            => '$country.name',
                'crawl_date'              => '$detection_result.crawl_date',
                'checking_date'           => '$operator_review.review_date',
                'bot_status'              => '$detection_result.status',
                'supervisor_status'       => '$supervisor_review.status',
                'operator_status'         => '$operator_review.status',
                'has_document'            => [
                    '$cond' => [
                        'if'   =>  [ '$gt' => [ ['$size' => '$documents'] , 0 ] ],
                        'then' => true,
                        'else' => false
                    ]
                ]
            ]
        ];

        

        // List bot violation types
        $aggregateQuery[] = [
            '$lookup' => [
                'as'   => 'bot_violation_types',
                'from' => 'violation_types',
                'let'  => [ 'list_in_ids'=> '$bot_type_ids' ],
                'pipeline' => [
                    ['$addFields' => ['string_id' => ['$toString' => '$_id']] ],
                    [ '$match' =>
                        [
                            '$expr'=> [ '$and'=> [ '$in' => [ '$string_id', '$$list_in_ids' ] ] ]
                        ]
                    ],

                    ['$project'   => ['_id' => '$string_id', 'name' => 1, 'color' => 1 ]]
                ]
            ]
        ];
        if($isSupervisor || $isOperator) {
            // List supervisor violation types
            $aggregateQuery[] = [
                '$lookup' => [
                    'as'   => 'supervisor_violation_types',
                    'from' => 'violation_types',
                    'let'  => [ 'list_in_ids'=> '$supervisor_type_ids' ],
                    'pipeline' => [
                        ['$addFields' => ['string_id' => ['$toString' => '$_id']] ],
                        [ '$match' =>
                            [
                                '$expr'=> [ '$and'=> [ '$in' => [ '$string_id', '$$list_in_ids' ] ] ]
                            ]
                        ],

                        ['$project'   => ['_id' => '$string_id', 'name' => 1, 'color' => 1 ]]
                    ]
                ]
            ];
        }
        if($isOperator) {
            // List operator violation types
            $aggregateQuery[] = [
                '$lookup' => [
                    'as'   => 'operator_violation_types',
                    'from' => 'violation_types',
                    'let'  => [ 'list_in_ids'=> '$operator_type_ids' ],
                    'pipeline' => [
                        ['$addFields' => ['string_id' => ['$toString' => '$_id']] ],
                        [ '$match' =>
                            [
                                '$expr'=> [ '$and'=> [ '$in' => [ '$string_id', '$$list_in_ids' ] ] ]
                            ]
                        ],

                        ['$project'   => ['_id' => '$string_id', 'name' => 1, 'color' => 1 ]]
                    ]
                ]
            ];
        }

        if(isset($params['status']) && $params['status'] === self::STATUS_VIOLATION ) {
            $aggregateQuery[] = [
                '$addFields' => [
                    'has_document' => [
                        '$cond' => [
                            'if'   =>  [ '$gt' => [ ['$size' => '$documents'] , 0 ] ],
                            'then' => true,
                            'else' => false
                        ]
                    ],
                    'penalty_issued' => [
                        '$cond' => [
                            'if'   =>  [ '$gt' => [ ['$size' => '$documents'] , 0 ] ],
                            'then' => ['$first' => '$documents.upload_date'],
                            'else' => null
                        ]
                    ]
                ]
            ];
        }

        if(isset($params['violation_type_id'])) {
            $aggregateQuery[] = [
                '$match' =>
                [
                    $violationReviewField.'.violation_types' => [
                        '$elemMatch' => [
                            'id' => $params['violation_type_id']
                        ]
                    ]
                ]
            ];
        }

        if(isset($params['violation_code_id'])) {
            $aggregateQuery[] = [
                '$match' =>
                [
                    $violationReviewField.'.violation_code' => [
                        '$elemMatch' => [
                            'id' => $params['violation_code_id']
                        ]
                    ]
                ]
            ];
        }

        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $regex = new Regex('.*'.$keyword, 'i');
            $keywordRegex = [ '$regex' => $regex ];

            $searchMatchCondition = [
                [ 'company_name'   => $keywordRegex ],
                [ 'brand_name'     => $keywordRegex ],
                [ 'country_name'   => $keywordRegex ],
                [ 'caption'        => $keywordRegex ],
                [ 'bot_type_names' => $keywordRegex ],
                [ 'bot_code_names' => $keywordRegex ]
            ];

            if($isSupervisor || $isOperator) {
                $searchMatchCondition[] = [ 'supervisor_type_names' => $keywordRegex ];
                $searchMatchCondition[] = [ 'supervisor_code_names' => $keywordRegex ];
            }
            if($isOperator) {
                $searchMatchCondition[] = [ 'operator_type_names' => $keywordRegex ];
                $searchMatchCondition[] = [ 'operator_code_names' => $keywordRegex ];
            }

            $aggregateQuery[] = [
                '$match' =>
                [
                    '$or'=> $searchMatchCondition
                ],
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

    public function getList($params, $usePagination = true) {
        // Custom query
        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $total = $this->aggregateCount($params);

        $aggregateQuery = $this->aggregateQuery($params);

        if(isset($params['status'])
            && ($params['status'] == self::STATUS_VIOLATION || $params['status'] == self::STATUS_NONE_VIOLATION)){
            $this->sortField = 'modified';
            $this->sortValue = self::SORT_VALUE;
        }

        if(isset($params['perpage'])) {
            $this->perpage = intval($params['perpage']);
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

        if($usePagination) {
            $aggregateQuery[] = ['$skip' => ($page - 1) * $this->perpage];
            $aggregateQuery[] = ['$limit' => $this->perpage];
        }

        $collection = self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });

        return new \Illuminate\Pagination\LengthAwarePaginator($collection, $total, $this->perpage, $page, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
        ]);
    }

    public function getListCount($params) {
        $count = $this->aggregateCount($params);
        return $count;
    }
}
