<?php

use App\Enums\Guard;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('client email verification screen can be rendered', function () {
    $authUser = Client::factory()->create(['email_verified_at' => null]);
    $response = $this->actingAs($authUser, Guard::CLIENT->toString())->get(route('client.verification.notice'));
    $response->assertStatus(200);
});

test('client email can be verified', function () {
    $authUser = Client::factory()->create(['email_verified_at' => null]);
    Event::fake();
    $verificationUrl = URL::temporarySignedRoute('client.verification.verify', now()->addMinutes(60), [
        'id' => $authUser->id, 'hash' => sha1($authUser->email)
    ]);
    $response = $this->actingAs($authUser, Guard::CLIENT->toString())->get($verificationUrl);
    Event::assertDispatched(Verified::class);
    expect($authUser->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(RouteServiceProvider::CLIENT . '?verified=1');
});

test('client email is not verified with invalid hash', function () {
    $authUser = Client::factory()->create(['email_verified_at' => null]);
    $verificationUrl = URL::temporarySignedRoute('client.verification.verify', now()->addMinutes(60), [
        'id' => $authUser->id, 'hash' => sha1('wrong-email')
    ]);
    $this->actingAs($authUser, Guard::CLIENT->toString())->get($verificationUrl);
    expect($authUser->fresh()->hasVerifiedEmail())->toBeFalse();
});
