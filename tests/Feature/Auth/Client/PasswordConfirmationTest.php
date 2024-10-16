<?php

use App\Enums\Guard;
use App\Models\Client;

test('client confirm password screen can be rendered', function () {
    $authUser = Client::factory()->create();
    $response = $this->actingAs($authUser, Guard::CLIENT->toString())->get(route('client.password.confirm'));
    $response->assertStatus(200);
});

test('client password can be confirmed', function () {
    $authUser = Client::factory()->create();
    $response = $this->actingAs($authUser, Guard::CLIENT->toString())->post(route('client.password.process'), ['password' => 'password']);
    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('client password is not confirmed with invalid password', function () {
    $authUser = Client::factory()->create();
    $response = $this->actingAs($authUser, Guard::CLIENT->toString())->post(route('client.password.process'), ['password' => 'wrong-password']);
    $response->assertSessionHasErrors();
});
