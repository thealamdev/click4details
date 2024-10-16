<?php

use App\Providers\RouteServiceProvider;

test('client registration screen can be rendered', function () {
    $response = $this->get(route('client.register.create'));
    $response->assertStatus(200);
});

test('client new users can register', function () {
    $response = $this->post(route('client.register.store'), [
        'name'      => 'Test User',
        'email'     => 'test@example.com',
        'password'  => 'password',
        'password_confirmation' => 'password',
    ]);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::CLIENT);
});
