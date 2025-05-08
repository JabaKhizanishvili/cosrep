<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\AuthType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard('web')->check()) {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //for customer redirect
                if ($guard == AuthType::TYPE_CUSTOMER && Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::CUSTOMER_HOME);
                }

                if($guards == AuthType::TYPE_EXTERNAL_CUSTOMER && Auth::guard($guard)->check()){
                    return redirect(RouteServiceProvider::CUSTOMER_HOME);
                }

                if ($guard == AuthType::TYPE_ADMIN && Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                }
            }
        }

        return $next($request);
    }
}
