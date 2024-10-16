<?php

namespace App\Http\Controllers\Auth\CustomerCare;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function create(Request $request): View|Factory|Application
    {
        return view('auth.merchant.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request
     * @param  Request          $request
     * @return RedirectResponse
     * @noinspection PhpUndefinedFieldInspection
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token'     => ['required'],
            'email'     => ['required', 'email', 'exists:merchants,email'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise, we will parse the error and return the response.
        $status = Password::broker(Guard::MERCHANT->toBroker())->reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user) use ($request) {
            $user->forceFill(['password' => Hash::make($request->password), 'remember_token' => Str::random(60)])->save();
            event(new PasswordReset($user));
        });

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('merchant.login.create')->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
