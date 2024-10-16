<?php

use App\Models\User;

test('admin confirm password screen can be rendered', function () {
    $authUser = User::factory()->create();
    $response = $this->actingAs($authUser)->get(route('admin.password.confirm'));
    $response->assertStatus(200);
});

test('admin password can be confirmed', function () {
    $authUser = User::factory()->create();
    $response = $this->actingAs($authUser)->post(route('admin.password.process'), ['password' => 'password']);
    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('admin password is not confirmed with invalid password', function () {
    $authUser = User::factory()->create();
    $response = $this->actingAs($authUser)->post(route('admin.password.process'), ['password' => 'wrong-password']);
    $response->assertSessionHasErrors();
});
