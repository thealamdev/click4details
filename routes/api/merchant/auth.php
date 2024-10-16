<?php

use App\Http\Controllers\Api\Merchant\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('merchant')->group(function () {

    Route::prefix('auth')->name('auth.')->group(function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::post('register', 'register')->name('register');
            Route::post('login', 'login')->name('login');
            Route::delete('delete/{merchant}', 'destroy')->name('delete')->middleware('auth:sanctum');
        });
    });
});
