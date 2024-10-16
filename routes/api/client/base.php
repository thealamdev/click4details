<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\Vehicle\VehicleController;

Route::prefix('clients')->group(function () {
    Route::prefix('vehicles')->name('vehicle')->group(function () {
        Route::prefix('products')->name('product.')->group(function () {
            Route::controller(VehicleController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('features/{vehicle}', 'features')->name('features');
                Route::get('{product}/detail', 'detail')->name('detail');
                Route::get('search', 'search')->name('search');
            });
        });
    });
});
