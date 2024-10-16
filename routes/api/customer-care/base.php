<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerCare\Vehicle\VehicleController;



Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('customer-care')->group(function () {

        Route::prefix('products')->name('product.')->group(function () {
            Route::controller(VehicleController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('search', 'search')->name('search');
            });
        });
    });
});
