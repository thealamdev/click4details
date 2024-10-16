<?php

use App\Enums\Guard;
use App\Models\Merchant;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

test('reset password link screen can be rendered', function () {
    $response = $this->get(route('merchant.password.request'));
    $response->assertStatus(200);
});

test('reset password link can be requested', function () {
    Notification::fake();
    $authUser = Merchant::factory()->create();
    $this->post(route('merchant.password.email'), ['email' => $authUser->email]);
    Notification::assertSentTo($authUser, ResetPasswordNotification::class);
});

test('reset password screen can be rendered', function () {
    Notification::fake();
    $authUser = Merchant::factory()->create();
    $this->post(route('merchant.password.email'), ['email' => $authUser->email]);
    Notification::assertSentTo($authUser, ResetPasswordNotification::class, function ($notification) {
        $hasToken = Str::of($notification->urlPath)->before('?')->replace(sprintf('%s/merchant/reset-password/', env('APP_URL')), '')->toString();
        $response = $this->get(route('merchant.password.request', ['token' => $hasToken]));
        $response->assertStatus(200);
        return true;
    });
});

test('password can be reset with valid token', function () {
    Notification::fake();
    $authUser = Merchant::factory()->create();
    $this->post(route('merchant.password.email'), ['email' => $authUser->email]);

    Notification::assertSentTo($authUser, ResetPasswordNotification::class, function ($notification) use ($authUser) {
        $hasToken = Str::of($notification->urlPath)->before('?')->replace(sprintf('%s/merchant/reset-password/', env('APP_URL')), '')->toString();
        $response = $this->actingAs($authUser, Guard::MERCHANT->toString())->post(route('merchant.password.store'), [
            'token'     => $hasToken,
            'email'     => $authUser->email,
            'password'  => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasNoErrors();
        return true;
    });
});
