<?php

namespace App\Http\Controllers\Auth\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('auth.merchant.register');
    }

    /**
     * Handle an incoming registration request
     * @param  Request          $request
     * @return RedirectResponse
     * @noinspection PhpUndefinedMethodInspection
     * @noinspection PhpUndefinedFieldInspection
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:' . Merchant::class],
            'mobile'     => ['required', 'string', 'max:14', 'unique:' . Merchant::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Merchant::create(['name' => $request->name, 'email' => $request->email, 'mobile' => $request->mobile, 'password' => Hash::make($request->password)]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::MERCHANT);
    }
}
