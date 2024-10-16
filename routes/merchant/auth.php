<?php

use App\Http\Controllers\Auth\Merchant\AuthenticatedSessionController;
use App\Http\Controllers\Auth\Merchant\ConfirmablePasswordController;
use App\Http\Controllers\Auth\Merchant\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\Merchant\EmailVerificationPromptController;
use App\Http\Controllers\Auth\Merchant\NewPasswordController;
use App\Http\Controllers\Auth\Merchant\PasswordController;
use App\Http\Controllers\Auth\Merchant\PasswordResetLinkController;
use App\Http\Controllers\Auth\Merchant\RegisteredUserController;
use App\Http\Controllers\Auth\Merchant\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:merchant')->group(function () {
    Route::controller(RegisteredUserController::class)->prefix('register')->name('register.')->group(function () {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

    Route::controller(AuthenticatedSessionController::class)->prefix('login')->name('login.')->group(function () {
        Route::get('/', 'create')->name('create');
        Route::post('/', 'store')->name('store');
    });

    Route::controller(PasswordResetLinkController::class)->prefix('forgot-password')->name('password.')->group(function () {
        Route::get('/', 'create')->name('request');
        Route::post('/', 'store')->name('email');
    });

    Route::controller(NewPasswordController::class)->prefix('reset-password')->name('password.')->group(function () {
        Route::get('{token}', 'create')->name('reset');
        Route::post('/', 'store')->name('store');
    });
});

Route::middleware('auth:merchant')->group(function () {
    Route::controller(EmailVerificationPromptController::class)->prefix('verify-email')->name('verification.')->group(function () {
        Route::get('/', '__invoke')->name('notice');
    });

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::controller(ConfirmablePasswordController::class)->prefix('confirm-password')->name('password.')->group(function () {
        Route::get('/', 'show')->name('confirm');
        Route::post('/', 'store')->name('process');
    });

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
