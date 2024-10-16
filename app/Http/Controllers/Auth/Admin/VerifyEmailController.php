<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified
     * @param  EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user(Guard::ADMIN->toString())->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::ADMIN.'?verified=1');
        }
        if ($request->user(Guard::ADMIN->toString())->markEmailAsVerified()) {
            event(new Verified($request->user(Guard::ADMIN->toString())));
        }
        return redirect()->intended(RouteServiceProvider::ADMIN.'?verified=1');
    }
}
