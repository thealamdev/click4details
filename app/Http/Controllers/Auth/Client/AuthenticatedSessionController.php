<?php

namespace App\Http\Controllers\Auth\Client;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ClientLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('auth.client.login');
    }

    /**
     * Handle an incoming authentication request
     * @param  ClientLoginRequest  $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(ClientLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::CLIENT);
    }

    /**
     * Destroy an authenticated session
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard(Guard::CLIENT->toString())->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('client.login.create');
    }
}
