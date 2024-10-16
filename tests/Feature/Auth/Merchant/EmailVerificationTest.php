<?php

use App\Enums\Guard;
use App\Models\Merchant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('merchant email verification screen can be rendered', function () {
    $authUser = Merchant::factory()->create(['email_verified_at' => null]);
    $response = $this->actingAs($authUser, Guard::MERCHANT->toString())->get(route('merchant.verification.notice'));
    $response->assertStatus(200);
});

test('merchant email can be verified', function () {
    $authUser = Merchant::factory()->create(['email_verified_at' => null]);
    Event::fake();
    $verificationUrl = URL::temporarySignedRoute('merchant.verification.verify', now()->addMinutes(60), [
        'id' => $authUser->id, 'hash' => sha1($authUser->email)
    ]);
    $response = $this->actingAs($authUser, Guard::MERCHANT->toString())->get($verificationUrl);
    Event::assertDispatched(Verified::class);
    expect($authUser->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(RouteServiceProvider::MERCHANT . '?verified=1');
});

test('merchant email is not verified with invalid hash', function () {
    $authUser = Merchant::factory()->create(['email_verified_at' => null]);
    $verificationUrl = URL::temporarySignedRoute('merchant.verification.verify', now()->addMinutes(60), [
        'id' => $authUser->id, 'hash' => sha1('wrong-email')
    ]);
    $this->actingAs($authUser)->get($verificationUrl);
    expect($authUser->fresh()->hasVerifiedEmail())->toBeFalse();
});
