<?php

use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:client', 'verified.client'])->group(function () {
    Route::controller(DashboardController::class)->prefix('user-dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });
});
