<?php

namespace App\Http\Middleware;

use App\Enums\Guard;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string   ...$guards
     * @return Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return match ($guard) {
                    Guard::ADMIN->toString()    => redirect(RouteServiceProvider::ADMIN),
                    Guard::MERCHANT->toString() => redirect(RouteServiceProvider::MERCHANT),
                    Guard::CLIENT->toString()   => redirect(RouteServiceProvider::CLIENT),
                    Guard::CUSTOMERCARE->toString()   => redirect(RouteServiceProvider::CUSTOMERCARE),
                    default                     => redirect(RouteServiceProvider::HOME)
                };
            }
        }
        return $next($request);
    }
}
