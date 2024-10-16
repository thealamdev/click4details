<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('admin email verification screen can be rendered', function () {
    $authUser = User::factory()->create(['email_verified_at' => null]);
    $response = $this->actingAs($authUser)->get(route('admin.verification.notice'));
    $response->assertStatus(200);
});

test('admin email can be verified', function () {
    $authUser = User::factory()->create(['email_verified_at' => null]);
    Event::fake();
    $verificationUrl = URL::temporarySignedRoute('admin.verification.verify', now()->addMinutes(60), [
        'id' => $authUser->id, 'hash' => sha1($authUser->email)
    ]);
    $response = $this->actingAs($authUser)->get($verificationUrl);
    Event::assertDispatched(Verified::class);
    expect($authUser->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(RouteServiceProvider::ADMIN . '?verified=1');
});

test('admin email is not verified with invalid hash', function () {
    $authUser = User::factory()->create(['email_verified_at' => null]);
    $verificationUrl = URL::temporarySignedRoute('admin.verification.verify', now()->addMinutes(60), [
        'id' => $authUser->id, 'hash' => sha1('wrong-email')
    ]);
    $this->actingAs($authUser)->get($verificationUrl);
    expect($authUser->fresh()->hasVerifiedEmail())->toBeFalse();
});
