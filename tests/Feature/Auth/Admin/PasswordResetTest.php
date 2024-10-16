<?php

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

test('admin reset password link screen can be rendered', function () {
    $response = $this->get(route('admin.password.request'));
    $response->assertStatus(200);
});

test('admin reset password link can be requested', function () {
    Notification::fake();
    $authUser = User::factory()->create();
    $this->post(route('admin.password.email'), ['email' => $authUser->email]);
    Notification::assertSentTo($authUser, ResetPasswordNotification::class);
});

test('admin reset password screen can be rendered', function () {
    Notification::fake();
    $authUser = User::factory()->create();
    $this->post(route('admin.password.email'), ['email' => $authUser->email]);
    Notification::assertSentTo($authUser, ResetPasswordNotification::class, function ($notification) {
        $hasToken = Str::of($notification->urlPath)->before('?')->replace(sprintf('%s/admin/reset-password/', env('APP_URL')), '')->toString();
        $response = $this->get(route('admin.password.request', ['token' => $hasToken]));
        $response->assertStatus(200);
        return true;
    });
});

test('admin password can be reset with valid token', function () {
    Notification::fake();
    $authUser = User::factory()->create();
    $this->post(route('admin.password.email'), ['email' => $authUser->email]);

    Notification::assertSentTo($authUser, ResetPasswordNotification::class, function ($notification) use ($authUser) {
        $hasToken = Str::of($notification->urlPath)->before('?')->replace(sprintf('%s/admin/reset-password/', env('APP_URL')), '')->toString();
        $response = $this->post(route('admin.password.store'), [
            'token'     => $hasToken,
            'email'     => $authUser->email,
            'password'  => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasNoErrors();
        return true;
    });
});
