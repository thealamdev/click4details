<?php

namespace App\Http\Controllers\Auth\Merchant;

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
        if ($request->user(Guard::MERCHANT->toString())->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::MERCHANT.'?verified=1');
        }
        if ($request->user(Guard::MERCHANT->toString())->markEmailAsVerified()) {
            event(new Verified($request->user(Guard::MERCHANT->toString())));
        }
        return redirect()->intended(RouteServiceProvider::MERCHANT.'?verified=1');
    }
}
