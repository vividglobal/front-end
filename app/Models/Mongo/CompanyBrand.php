<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class CompanyBrand extends Model
{
    protected $collection = 'company_brands';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    const TYPE_COMPANY = 'COMPANY';
    const TYPE_BRAND = 'BRAND';

    protected $fillable = [
        'name',
        'type',
        'parent_id'
    ];
}
