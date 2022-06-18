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
    const SORT_VALUE = 'DESC';

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

    public function documents()
    {
        return $this->embedsMany(ArticleLegalDocument::class, '_id', 'article_id');
    }

    private function generalQuery($params) {
        $query = $this->newQuery();

        if(isset($params['keyword'])) {
            $query->where('country.name', 'LIKE' ,'%' .$params['keyword']. '%')
            ->orwhere('brand.name', 'LIKE' ,'%' .$params['keyword']. '%')
            ->orwhere('caption', 'LIKE' ,'%' .$params['keyword']. '%');
        }

        if(isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date']);
            $endDate = strtotime($params['end_date']);
            $query->whereRaw([
                'detection_result.date' => ['$gte' => $startDate, '$lte' => $endDate],
            ]);
        }

        if(isset($params['country'])) {
            $query->where('country.id', $params['country']);
        }

        if(isset($params['company_brand_id'])) {
            $brandId = $params['company_brand_id'];
            $query->where('brand.id', $brandId);
        }

        if(isset($params['violation_type_id'])) {
            $query->whereRaw([
                'detection_result.violation_types.id' => [ '$eq' => $params['violation_type_id'] ]
            ]);
        }

        return $query;
    }

    public function getList($params, $perpage = self::PER_PAGE, $sortField = self::SORT_BY_FIELD, $sortValue = self::SORT_VALUE) {
        // DB::connection( 'mongodb' )->enableQueryLog();
        $articles = $this->generalQuery($params);

        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            // TODO
        }

        if(isset($params['detection_type'])) {
            $articles->where('detection_type', $params['detection_type']);
        }

        if(isset($params['perpage'])) {
            $perpage = $params['perpage'];
        }

        if(isset($params['sort_by'])) {
            $sortField = $params['sort_by'];
        }
        if(isset($params['sort_value'])) {
            $sortValue = $params['sort_value'];
        }
        $list = $articles->orderBy($sortField, strtolower($sortValue))->paginate(intval($perpage))->withQueryString();
        return $list;
    }

    public function getListCount($params) {
        $articles = $this->generalQuery($params);
        $count = $articles->count();
        return $count;
    }
}
