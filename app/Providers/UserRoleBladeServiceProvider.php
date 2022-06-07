<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Http\Services\UserRoleService;

class UserRoleBladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('is_admin', function () {            
            return UserRoleService::isAdmin();
        });

        Blade::if('is_supervisor', function () {            
            return UserRoleService::isSupervisor();
        });

        Blade::if('is_operator', function () {            
            return UserRoleService::isOperator();
        });
    }
}
