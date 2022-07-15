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

    public function violationByCountries() {
        $aggregateQuery = [
            [
                '$lookup' => [
                    'as' => 'articles_by_country',
                    'from' => 'articles',
                    'let' => [ 'country_id'=> ['$toString'=> '$_id'] ],
                    'pipeline' => [
                        [ '$match'=>
                            [
                                '$expr'=>
                                [ '$and' => 
                                    [
                                        [ '$eq'=> [ '$country.id',  '$$country_id' ] ],
                                        [ '$eq'=> [ '$status',  Article::STATUS_VIOLATION ] ]
                                    ]
                                ]
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
