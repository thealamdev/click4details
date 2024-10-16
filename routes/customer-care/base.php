<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerCare\DashboardController;
use App\Http\Controllers\CustomerCare\Vehicle\VehicleController;



Route::middleware(['auth:customercare'])->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });


    Route::prefix('vehicles')->name('vehicle.')->group(function () {

        Route::prefix('products')->group(function () {
            Route::controller(VehicleController::class)->name('product.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::get('vehicleEdit', 'vehicleEdit')->name('vehicleEdit');
                Route::put('{product}/vehicleUpdate', 'vehicleUpdate')->name('vehicleUpdate');
                Route::get('/largeView', 'largeView')->name('largeView');
            });
        });
    });
});
