<?php

namespace App\Http\Middleware;

use App\Enums\Guard;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminEmailIsVerified
{
    /**
     * Handle an incoming request
     * @param  Request                      $request
     * @param  Closure(Request): (Response) $next
     * @param  string|null                  $redirectToRoute
     * @return Response
     */
    public function handle(Request $request, Closure $next, ?string $redirectToRoute = null): Response
    {
        if (!$request->user(Guard::ADMIN->toString()) || ($request->user(Guard::ADMIN->toString()) instanceof MustVerifyEmail && !$request->user(Guard::ADMIN->toString())->hasVerifiedEmail())) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'admin.verification.notice'));
        }
        return $next($request);
    }
}
