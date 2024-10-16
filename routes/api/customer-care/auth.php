<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerCare\Auth\AuthenticationController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('customer-care')->group(function () {

        Route::prefix('auth')->name('auth.')->group(function () {
            Route::controller(AuthenticationController::class)->group(function () {
                Route::post('register', 'register')->name('register');
                Route::delete('delete/{customerCare}', 'destroy')->name('delete');
            });
        });
    });
});

/** login without middleware */
Route::prefix('customer-care')->group(function () {

    Route::prefix('auth')->name('auth.')->group(function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::post('login', 'login')->name('login');
        });
    });
});
