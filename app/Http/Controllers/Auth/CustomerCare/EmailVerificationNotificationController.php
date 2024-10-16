<?php

namespace App\Http\Controllers\Auth\CustomerCare;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user(Guard::MERCHANT->toString())->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::MERCHANT);
        }
        $request->user(Guard::MERCHANT->toString())->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }
}
