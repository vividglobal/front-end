<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class ViolationCode extends Model
{
    protected $collection = 'violation_code';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'type_id'
    ];
}
