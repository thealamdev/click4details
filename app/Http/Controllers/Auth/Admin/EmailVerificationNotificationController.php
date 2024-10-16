<?php

namespace App\Http\Controllers\Auth\Admin;

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
        if ($request->user(Guard::ADMIN->toString())->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }
        $request->user(Guard::ADMIN->toString())->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }
}
