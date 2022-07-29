<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Mongo\Article;

class Country extends Model
{
    protected $collection = 'countries';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'list_url'
    ];

    public function violationByCountries($params = []) {
        $matchConditions = [
            [ '$eq'=> [ '$country.id',  '$$country_id' ] ],
            [ '$eq'=> [ '$status',  Article::STATUS_VIOLATION ] ]
        ];

        if(isset($params['start_date']) && isset($params['end_date'])) {
            $startDate = strtotime($params['start_date'].' 00:00:00');
            $endDate = strtotime($params['end_date'].' 23:59:59');

            $matchConditions[] = [ '$gte' => [ '$operator_review.review_date',  $startDate ] ];
            $matchConditions[] = [ '$lte' => [ '$operator_review.review_date',  $endDate ] ];
        }

        $aggregateQuery = [
            [
                '$lookup' => [
                    'as' => 'articles_by_country',
                    'from' => 'articles',
                    'let' => [ 'country_id'=> ['$toString'=> '$_id'] ],
                    'pipeline' => [
                        [ '$match'=>
                            [
                                '$expr'=> [ '$and' => $matchConditions ]
                            ]
                        ],
                        ['$project' => ['_id' => 1]]
                    ]
                ]
            ],
            [
                '$addFields' => [
                    'total_articles' => ['$size' => '$articles_by_country'],
                ]
            ],
            [
                '$project' => [
                    'country' => '$name',
                    'total_articles' => 1
                ]
            ]
        ];

        return self::raw(function ($collection) use ($aggregateQuery) {
            return $collection->aggregate($aggregateQuery);
        });
    }
}
