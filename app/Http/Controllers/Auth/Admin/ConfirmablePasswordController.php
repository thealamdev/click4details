<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view
     * @return Application|Factory|View
     */
    public function show(): View|Factory|Application
    {
        return view('auth.admin.confirm-password');
    }

    /**
     * Confirm the user's password
     * @param  Request             $request
     * @return RedirectResponse
     * @throws ValidationException
     * @noinspection PhpUndefinedFieldInspection
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::guard(Guard::ADMIN->toString())->validate(['email' => $request->user()->email, 'password' => $request->password])) {
            throw ValidationException::withMessages(['password' => __('auth.password')]);
        }
        $request->session()->put('auth.password_confirmed_at', time());
        return redirect()->intended(RouteServiceProvider::ADMIN);
    }
}
