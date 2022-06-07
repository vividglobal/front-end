<?php

namespace App\Http\Services;
use App\Models\Mongo\Admin;

class UserRoleService
{
    public static function isAdmin() {
        return (auth()->user() && auth()->user()->role === Admin::ROLE_ADMIN);
    }

    public static function isSupervisor() {
        return (auth()->user() && auth()->user()->role === Admin::ROLE_SUPERVISOR);
    }

    public static function isOperator() {
        return (auth()->user() && auth()->user()->role === Admin::ROLE_OPERATOR);
    }
}