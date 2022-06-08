<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Services\UserRoleService;
use App\Providers\RouteServiceProvider;
use  App\Http\Traits\ApiResponse;

class CheckRole
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $listRoles = explode("|", $roles);
        $currentRole = strtolower(UserRoleService::getRole());
        if(in_array($currentRole, $listRoles)) {
            return $next($request);
        }
        if ($request->isMethod('get')) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $this->responseFail($data = null, $message = 'Permission denied');
    }
}
