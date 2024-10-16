<?php

use App\Providers\RouteServiceProvider;

test('merchant registration screen can be rendered', function () {
    $response = $this->get(route('merchant.register.create'));
    $response->assertStatus(200);
});

test('merchant new users can register', function () {
    $response = $this->post(route('merchant.register.store'), [
        'name'      => 'Test User',
        'email'     => 'test@example.com',
        'password'  => 'password',
        'password_confirmation' => 'password',
    ]);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::MERCHANT);
});
