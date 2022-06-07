<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class Country extends Model
{
    protected $collection = 'countries';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'list_url'
    ];
}
