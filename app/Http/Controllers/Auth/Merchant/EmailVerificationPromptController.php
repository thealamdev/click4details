<?php

namespace App\Http\Controllers\Auth\Merchant;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt
     * @param  Request               $request
     * @return RedirectResponse|View
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user(Guard::MERCHANT->toString())->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::MERCHANT)
            : view('auth.merchant.verify-email');
    }
}
