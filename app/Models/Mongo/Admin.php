<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\BSON\Regex;
use App\Http\Services\UserRoleService;

class Admin extends Model
{
    protected $collection = 'users';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_SUPERVISOR = 'SUPERVISOR';
    const ROLE_OPERATOR = 'OPERATOR';

    const DEFAULT_LIMIT = 25;

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

    public function getList($params) {
        $perpage = $params['perpage'] ?? self::DEFAULT_LIMIT;
        $newQuery = $this->newQuery();
        if(isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $newQuery->orderBy('created_at', 'DESC')->where("full_name","LIKE", "%{$keyword}%")->orwhere("email","LIKE", "%{$keyword}%")
                        ->orwhere("phone_number","LIKE", "%{$keyword}%")->orwhere("role","LIKE", "%{$keyword}%");
        }
        $admins = $newQuery->orderBy('created_at', 'DESC')->paginate($perpage);

        return $admins;
    }
}
