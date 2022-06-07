<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class Admin extends Model
{
    protected $collection = 'users';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_SUPERVISOR = 'SUPERVISOR';
    const ROLE_OPERATOR = 'OPERATOR';

    protected $fillable = [
        'full_name',
        'password',
        'email',
        'phone_number',
        'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
