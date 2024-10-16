<?php

namespace App\Http\Controllers\Merchant;

use App\Enums\Guard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\ProfileUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function edit(Request $request): View|Factory|Application
    {
        $user = $request->user(Guard::MERCHANT->toString());
        return view('content.merchant.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information
     * @param  ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user(Guard::MERCHANT->toString())->fill($request->validated());
        if ($request->user(Guard::MERCHANT->toString())->isDirty('email')) {
            $request->user(Guard::MERCHANT->toString())->email_verified_at = null;
        }
        $request->user(Guard::MERCHANT->toString())->save();
        return Redirect::route('content.merchant.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account
     * @param  Request          $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', ['password' => ['required', 'current_password']]);
        $user = $request->user(Guard::MERCHANT->toString());
        Auth::guard(Guard::MERCHANT->toString())->logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }
}
