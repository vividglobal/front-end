<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use  App\Http\Traits\ApiResponse;

class ApiAuthenticate
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // var_dump($request->bearerToken());
        if($request->header("at-api-key") === env('AT_API_KEY_SECRET')) {
            return $next($request);
        }
        return $this->responseFail($data = null, $message = 'Permission denied');
    }
}
