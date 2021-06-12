<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth('sanctum')->check() || !auth('sanctum')->user()->tokenCan('admin')) {
            return response(["message" => config('responses.unauthorized')]);
        } else {
            return $next($request);
        }
    }
}
