<?php

namespace App\Http\Middleware;

use App\Enums\Guard;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class EnsureClientEmailIsVerified
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
        if (!$request->user(Guard::CLIENT->toString()) || ($request->user(Guard::CLIENT->toString()) instanceof MustVerifyEmail && !$request->user(Guard::CLIENT->toString())->hasVerifiedEmail())) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'client.verification.notice'));
        }
        return $next($request);
    }
}
