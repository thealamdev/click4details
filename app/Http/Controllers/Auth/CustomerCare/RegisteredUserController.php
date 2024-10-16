<?php

namespace App\Http\Controllers\Auth\CustomerCare;

use App\Models\Merchant;
use App\Models\CustomerCare;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('auth.customer-care.register');
    }

    /**
     * Handle an incoming registration request
     * @param  Request          $request
     * @return RedirectResponse
     * @noinspection PhpUndefinedMethodInspection
     * @noinspection PhpUndefinedFieldInspection
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:' . CustomerCare::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $merchantUser = Auth::guard('merchant')->user();

        $user = CustomerCare::create([
            'parent_type' => Merchant::class,
            'parent_id' => $merchantUser->id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));
        // Auth::login($user);
        return back()->with('status', 'Merchants Customer Care created');
        // return redirect(RouteServiceProvider::MERCHANT);
    }
}
