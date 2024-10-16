<?php

namespace App\Http\Controllers\Auth\Client;

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
        if ($request->user(Guard::CLIENT->toString())->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::CLIENT);
        }
        $request->user(Guard::CLIENT->toString())->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }
}
