<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

test('admin login screen can be rendered', function () {
    $response = $this->get(route('admin.login.create'));
    $response->assertStatus(200);
});

test('admin users can authenticate using the login screen', function () {
    $authUser = User::factory()->create();
    $response = $this->post(route('admin.login.store'), ['email' => $authUser->email, 'password' => 'password']);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::ADMIN);
});

test('admin users can not authenticate with invalid password', function () {
    $authUser = User::factory()->create();
    $this->post(route('admin.login.store'), ['email' => $authUser->email, 'password' => 'wrong-password']);
    $this->assertGuest();
});
