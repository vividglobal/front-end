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
    const SORT_BY_FIELD = 'bot_detecting.crawl_date';
    const SORT_VALUE = 'DESC';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    const STATUS_PENDING = 'PENDING';
    const STATUS_VIOLATION = 'VIOLATION';
    const STATUS_NONE_VIOLATION = 'NONE_VIOLATION';

    const PROGRESS_NOT_STARTED = 'NOT_STARTED';
    const PROGRESS_PROCESSING = 'PROCESSING';
    const PROGRESS_COMPLETED = 'COMPLETED';

    const DETECTION_TYPE_BOT = 'BOT';
    const DETECTION_TYPE_MANUAL = 'MANUAL';

    const STATUS_REVIEW_PENDING = 'PENDING';
    const STATUS_REVIEW_DONE = 'DONE';

    protected $fillable = [
        'company',
        'country',
        'brand',
        'caption',
        'image',
        'published_date',
        'link',
        'bot_detecting',
        'supervisor_review',
        'operator_review',
        'status',
        'progress_status',
        'detection_type'
    ];

    protected $attributes = [
        'bot_detecting' => [
            'violation_code' => [],
            'violation_types' => [],
            'crawl_date' => null
        ],
        'operator_review' => [
            'violation_code' => [],
            'violation_types' => [],
            'status' => self::STATUS_REVIEW_PENDING,
            'review_date' => null
        ],
        'supervisor_review' => [
            'violation_code' => [],
            'violation_types' => [],
            'status' => self::STATUS_REVIEW_PENDING,
            'review_date' => null
        ],
    ];

    public function getList($params, $perpage = self::PER_PAGE, $sortField = self::SORT_BY_FIELD, $sortValue = self::SORT_VALUE) {
        // DB::connection( 'mongodb' )->enableQueryLog();
        $articles = $this->newQuery();

        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            // TODO
        }

        if(isset($params['status'])) {
            $articles->where('status', $params['status']);
        }

        if(isset($params['detection_type'])) {
            $articles->where('detection_type', $params['detection_type']);
        }

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date']);
            $endDate = strtotime($params['end_date']);
            $articles->whereRaw([
                'bot_detecting.crawl_date' => ['$gte' => $startDate, '$lte' => $endDate],
            ]);
        }

        if(isset($params['country'])) {
            $articles->where('country', $params['country']);
        }

        if(isset($params['company_brand'])) {
            $GLOBALS['company_brand'] = $params['company_brand'];
            $articles->orWhere(function ($query) {
                return $query
                    ->where('company', '=', $GLOBALS['company_brand'])
                    ->where('brand', '=', $GLOBALS['company_brand']);
            });
        }

        if(isset($params['violation_type'])) {
            $articles->whereIn('bot_detecting.violation_types', [$params['violation_type']]);
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
        $list = $articles->orderBy($sortField, strtolower($sortValue))->paginate($perpage);
        // dd(DB::connection('mongodb')->getQueryLog());
        return $list;
    }
}
