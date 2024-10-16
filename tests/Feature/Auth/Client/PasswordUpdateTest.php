<?php

use App\Models\Client;
use Illuminate\Support\Facades\Hash;

test('client password can be updated', function () {
    $this->markTestSkipped('test has been skipped');
    $authUser = Client::factory()->create();
    $response = $this->actingAs($authUser)->from('/profile')->put('/password', [
        'current_password'      => 'password',
        'password'              => 'new-password',
        'password_confirmation' => 'new-password',
    ]);
    $response->assertSessionHasNoErrors()->assertRedirect('/profile');
    $this->assertTrue(Hash::check('new-password', $authUser->refresh()->password));
});

test('client correct password must be provided to update password', function () {
    $this->markTestSkipped('test has been skipped');
    $authUser = Client::factory()->create();
    $response = $this->actingAs($authUser)->from('/profile')->put('/password', [
        'current_password'      => 'wrong-password',
        'password'              => 'new-password',
        'password_confirmation' => 'new-password',
    ]);
    $response->assertSessionHasErrorsIn('updatePassword', 'current_password')->assertRedirect('/profile');
});
