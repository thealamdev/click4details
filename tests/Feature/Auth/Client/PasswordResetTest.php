<?php

use App\Enums\Guard;
use App\Models\Client;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

test('client reset password link screen can be rendered', function () {
    $response = $this->get(route('client.password.request'));
    $response->assertStatus(200);
});

test('client reset password link can be requested', function () {
    Notification::fake();
    $authUser = Client::factory()->create();
    $this->post(route('client.password.email'), ['email' => $authUser->email]);
    Notification::assertSentTo($authUser, ResetPasswordNotification::class);
});

test('client reset password screen can be rendered', function () {
    Notification::fake();
    $authUser = Client::factory()->create();
    $this->post(route('client.password.email'), ['email' => $authUser->email]);
    Notification::assertSentTo($authUser, ResetPasswordNotification::class, function ($notification) {
        $hasToken = Str::of($notification->urlPath)->before('?')->replace(sprintf('%s/reset-password/', env('APP_URL')), '')->toString();
        $response = $this->get(route('client.password.request', ['token' => $hasToken]));
        $response->assertStatus(200);
        return true;
    });
});

test('client password can be reset with valid token', function () {
    Notification::fake();
    $authUser = Client::factory()->create();
    $this->post(route('client.password.email'), ['email' => $authUser->email]);

    Notification::assertSentTo($authUser, ResetPasswordNotification::class, function ($notification) use ($authUser) {
        $hasToken = Str::of($notification->urlPath)->before('?')->replace(sprintf('%s/reset-password/', env('APP_URL')), '')->toString();
        $response = $this->actingAs($authUser, Guard::CLIENT->toString())->post(route('client.password.store'), [
            'token'     => $hasToken,
            'email'     => $authUser->email,
            'password'  => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertSessionHasNoErrors();
        return true;
    });
});
