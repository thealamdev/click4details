<?php

use App\Enums\Guard;
use App\Models\Merchant;
use App\Providers\RouteServiceProvider;

test('merchant login screen can be rendered', function () {
    $response = $this->get(route('merchant.login.create'));
    $response->assertStatus(200);
});

test('merchant users can authenticate using the login screen', function () {
    $authUser = Merchant::factory()->create();
    $response = $this->actingAs($authUser, Guard::MERCHANT->toString())->post(route('merchant.login.store'), ['email' => $authUser->email, 'password' => 'password']);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::MERCHANT);
});

test('merchant users can not authenticate with invalid password', function () {
    $authUser = Merchant::factory()->create();
    $this->post(route('merchant.login.store'), ['email' => $authUser->email, 'password' => 'wrong-password']);
    $this->assertGuest();
});
