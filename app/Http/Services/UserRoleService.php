<?php

namespace App\Http\Services;
use App\Models\Mongo\Admin;

class UserRoleService
{
    public static function getRole() {
        return auth()->user()->role ?? null;
    }

    public static function isRole($role) {
        return (auth()->user() && isset(auth()->user()->role) && auth()->user()->role === $role);
    }

    public static function isAdmin() {
        return static::isRole(Admin::ROLE_ADMIN);
    }

    public static function isSupervisor() {
        return static::isRole(Admin::ROLE_SUPERVISOR);
    }

    public static function isOperator() {
        return static::isRole(Admin::ROLE_OPERATOR);
    }
}