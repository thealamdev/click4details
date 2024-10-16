<?php

use App\Enums\Guard;
use App\Models\Merchant;

test('merchant confirm password screen can be rendered', function () {
    $authUser = Merchant::factory()->create();
    $response = $this->actingAs($authUser, Guard::MERCHANT->toString())->get(route('merchant.password.confirm'));
    $response->assertStatus(200);
});

test('merchant password can be confirmed', function () {
    $authUser = Merchant::factory()->create();
    $response = $this->actingAs($authUser, Guard::MERCHANT->toString())->post(route('merchant.password.process'), ['password' => 'password']);
    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('merchant password is not confirmed with invalid password', function () {
    $authUser = Merchant::factory()->create();
    $response = $this->actingAs($authUser, Guard::MERCHANT->toString())->post(route('merchant.password.process'), ['password' => 'wrong-password']);
    $response->assertSessionHasErrors();
});
