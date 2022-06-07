<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class ViolationType extends Model
{
    protected $collection = 'violation_types';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'name',
        'color'
    ];
}
