<?php

use App\Enums\Guard;
use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;

test('client login screen can be rendered', function () {
    $response = $this->get(route('client.login.create'));
    $response->assertStatus(200);
});

test('client users can authenticate using the login screen', function () {
    $authUser = Client::factory()->create();
    $response = $this->actingAs($authUser, Guard::CLIENT->toString())->post(route('client.login.store'), ['email' => $authUser->email, 'password' => 'password']);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::CLIENT);
});

test('client users can not authenticate with invalid password', function () {
    $authUser = User::factory()->create();
    $this->post(route('client.login.store'), ['email' => $authUser->email, 'password' => 'wrong-password']);
    $this->assertGuest();
});
