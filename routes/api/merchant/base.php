<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Merchant\Vehicle\CodeController;
use App\Http\Controllers\Api\Merchant\Vehicle\FuelController;
use App\Http\Controllers\Api\Merchant\Vehicle\BrandController;
use App\Http\Controllers\Api\Merchant\Vehicle\ColorController;
use App\Http\Controllers\Api\Merchant\Vehicle\GradeController;
use App\Http\Controllers\Api\Merchant\Vehicle\EditionController;
use App\Http\Controllers\Api\Merchant\Vehicle\GalleryController;
use App\Http\Controllers\Api\Merchant\Vehicle\VehicleController;
use App\Http\Controllers\Api\Merchant\Vehicle\CarmodelController;
use App\Http\Controllers\Api\Merchant\Vehicle\SkeletonController;
use App\Http\Controllers\Api\Merchant\Vehicle\AvailableController;
use App\Http\Controllers\Api\Merchant\Vehicle\ConditionController;
use App\Http\Controllers\Api\Merchant\Vehicle\DescriptionController;
use App\Http\Controllers\Api\Merchant\Vehicle\RegistrationController;
use App\Http\Controllers\Api\Merchant\Vehicle\TransmissionController;

// Route::middleware(['auth:sanctum'])->group(function () {
Route::prefix('merchants')->group(function () {

    Route::prefix('vehicles')->name('vehicle.')->group(function () {

        Route::prefix('products')->name('product.')->group(function () {
            Route::controller(VehicleController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('features/{vehicle}', 'features')->name('features');
                Route::post('/', 'store')->name('store');
                Route::get('barnds', 'barnds')->name('barnds');
                Route::get('availables', 'availables')->name('availables');
                Route::put('{product}', 'update')->name('update');
                Route::get('search', 'search')->name('search');
                Route::get('stocklist', 'stocklist')->name('stocklist');
                Route::get('{product}', 'index')->name('index');
                Route::get('{product}/detail', 'detail')->name('detail');
                Route::put('{product}/update', 'priceUpdate')->name('priceUpdate');
                Route::put('{product}/update/booked', 'bookedUpdate')->name('bookedUpdate');
                Route::put('{product}/update/sold', 'soldUpdate')->name('soldUpdate');
                Route::put('{product}/available', 'availableUpdate')->name('availableUpdate');
                Route::delete('{product}', 'destroy')->name('delete');
            });
        });

        /**
         * routes for uploading description & multiple images of vehicles
         */
        Route::prefix('{vehicle}')->group(function () {
            Route::controller(DescriptionController::class)->prefix('descriptions')->name('description.')->group(function () {
                Route::post('/', 'store')->name('store');
            });

            Route::controller(GalleryController::class)->prefix('galleries')->name('gallery.')->group(function () {
                Route::post('/', 'store')->name('store');
                Route::delete('{gallery}', 'destroy')->name('delete');
            });
        });

        Route::prefix('brands')->name('brand')->group(function () {
            Route::controller(BrandController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('models')->name('model')->group(function () {
            Route::controller(CarmodelController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('editions')->name('edition')->group(function () {
            Route::controller(EditionController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('conditions')->name('condition')->group(function () {
            Route::controller(ConditionController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('transmissions')->name('transmission')->group(function () {
            Route::controller(TransmissionController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('fuels')->name('fuel')->group(function () {
            Route::controller(FuelController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('skeletons')->name('skeleton')->group(function () {
            Route::controller(SkeletonController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('colors')->name('color')->group(function () {
            Route::controller(ColorController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('availables')->name('available')->group(function () {
            Route::controller(AvailableController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('registrations')->name('registration')->group(function () {
            Route::controller(RegistrationController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('grades')->name('grade')->group(function () {
            Route::controller(GradeController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        Route::prefix('codes')->name('code')->group(function () {
            Route::controller(CodeController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });
    });
});
// });
