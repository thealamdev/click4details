<?php

use App\Providers\RouteServiceProvider;

test('admin registration screen can be rendered', function () {
    $response = $this->get(route('admin.register.create'));
    $response->assertStatus(200);
});

test('admin new users can register', function () {
    $response = $this->post(route('admin.register.store'), [
        'name'      => 'Test User',
        'email'     => 'test@example.com',
        'password'  => 'password',
        'password_confirmation' => 'password',
    ]);
    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::ADMIN);
});
