<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\MerchantInfoController;
use App\Http\Controllers\Merchant\CustomerCare\CustomerCareController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\Vehicle\FuelController;
use App\Http\Controllers\Merchant\Vehicle\BrandController;
use App\Http\Controllers\Merchant\Vehicle\ColorController;
use App\Http\Controllers\Merchant\Vehicle\GradeController;
use App\Http\Controllers\Merchant\Vehicle\EngineController;
use App\Http\Controllers\Merchant\Vehicle\EditionController;
use App\Http\Controllers\Merchant\Vehicle\GalleryController;
use App\Http\Controllers\Merchant\Vehicle\MileageController;
use App\Http\Controllers\Merchant\Vehicle\VehicleController;
use App\Http\Controllers\Merchant\Vehicle\CarmodelController;
use App\Http\Controllers\Merchant\Vehicle\SkeletonController;
use App\Http\Controllers\Merchant\Vehicle\AvailableController;
use App\Http\Controllers\Merchant\Vehicle\ConditionController;
use App\Http\Controllers\Merchant\Vehicle\DescriptionController;
use App\Http\Controllers\Merchant\Vehicle\PurchasePriceController;
use App\Http\Controllers\Merchant\Vehicle\RegistrationController;
use App\Http\Controllers\Merchant\Vehicle\TransmissionController;


Route::middleware(['auth:merchant', 'verified.merchant'])->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::controller(MerchantController::class)->prefix('merchants')->name('merchant.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{merchant}/profile', 'show')->name('show');
        Route::get('{merchant}/edit', 'edit')->name('edit');
        Route::put('{merchant}', 'update')->name('update');
        Route::delete('{merchant}', 'destroy')->name('delete');
        Route::put('{merchant}/change-password', 'changePassword')->name('changePassword');
    });

    Route::controller(MerchantInfoController::class)->prefix('merchantsInfo')->name('merchantInfo.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{merchant}/profile', 'show')->name('show');
        Route::get('{merchant}/edit', 'edit')->name('edit');
        Route::put('{merchant}', 'update')->name('update');
    });

    Route::prefix('customer-care')->name('customer-care.')->group(function () {
        Route::controller(CustomerCareController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('{customerCare}/edit', 'edit')->name('edit');
            Route::put('{customerCare}/update', 'update')->name('update');
            Route::delete('{customerCare}/delete', 'destroy')->name('delete');
        });
    });

    Route::prefix('vehicles')->name('vehicle.')->group(function () {

        Route::controller(PurchasePriceController::class)->prefix('purchase-price')->name('purchase-price.')->group(function () {
            Route::get('index/{vehicle}', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::post('/{vehicle}', 'priceStore')->name('priceStore');
            Route::get('/direct/{vehicle}', 'directView')->name('directView');
            Route::post('directStore/{vehicle}', 'directStore')->name('directStore');
        });

        Route::controller(BrandController::class)->prefix('brands')->name('brand.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{brand}/edit', 'edit')->name('edit');
            Route::put('{brand}', 'update')->name('update');
        });

        Route::controller(ColorController::class)->prefix('colors')->name('color.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{color}/edit', 'edit')->name('edit');
            Route::put('{color}', 'update')->name('update');
        });

        Route::controller(CarmodelController::class)->prefix('models')->name('model.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{model}/edit', 'edit')->name('edit');
            Route::put('{model}', 'update')->name('update');
            Route::delete('{model}', 'destroy')->name('delete');
        });

        Route::controller(AvailableController::class)->prefix('availables')->name('available.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{available}/edit', 'edit')->name('edit');
            Route::put('{available}', 'update')->name('update');
            Route::delete('{available}', 'destroy')->name('delete');
        });

        Route::controller(RegistrationController::class)->prefix('registrations')->name('registration.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{registration}/edit', 'edit')->name('edit');
            Route::put('{registration}', 'update')->name('update');
            Route::delete('{registration}', 'destroy')->name('delete');
        });


        Route::controller(EditionController::class)->prefix('editions')->name('edition.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{edition}/edit', 'edit')->name('edit');
            Route::put('{edition}', 'update')->name('update');
            Route::delete('{edition}', 'destroy')->name('delete');
        });

        Route::controller(ConditionController::class)->prefix('conditions')->name('condition.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{condition}/edit', 'edit')->name('edit');
            Route::put('{condition}', 'update')->name('update');
            Route::delete('{condition}', 'destroy')->name('delete');
        });

        Route::controller(EngineController::class)->prefix('engines')->name('engine.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{engine}/edit', 'edit')->name('edit');
            Route::put('{engine}', 'update')->name('update');
            Route::delete('{engine}', 'destroy')->name('delete');
        });

        Route::controller(FuelController::class)->prefix('fuels')->name('fuel.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{fuel}/edit', 'edit')->name('edit');
            Route::put('{fuel}', 'update')->name('update');
            Route::delete('{fuel}', 'destroy')->name('delete');
        });

        Route::controller(SkeletonController::class)->prefix('skeletons')->name('skeleton.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{skeleton}/edit', 'edit')->name('edit');
            Route::put('{skeleton}', 'update')->name('update');
            Route::delete('{skeleton}', 'destroy')->name('delete');
        });

        Route::controller(MileageController::class)->prefix('mileages')->name('mileage.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{mileage}/edit', 'edit')->name('edit');
            Route::put('{mileage}', 'update')->name('update');
            Route::delete('{mileage}', 'destroy')->name('delete');
        });

        Route::controller(TransmissionController::class)->prefix('transmissions')->name('transmission.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{transmission}/edit', 'edit')->name('edit');
            Route::put('{transmission}', 'update')->name('update');
            Route::delete('{transmission}', 'destroy')->name('delete');
        });

        Route::controller(GradeController::class)->prefix('grades')->name('grade.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{grade}/edit', 'edit')->name('edit');
            Route::put('{grade}', 'update')->name('update');
            Route::delete('{grade}', 'destroy')->name('delete');
        });

        Route::prefix('products')->group(function () {
            Route::controller(VehicleController::class)->name('product.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::get('show-all', 'show')->name('show');
                Route::put('{product}', 'update')->name('update');
                Route::delete('{product}', 'destroy')->name('delete');
                Route::get('secure', 'secure')->name('secure');
                Route::post('sendMail', 'sendMail')->name('sendMail');
                Route::get('vehicleEdit', 'vehicleEdit')->name('vehicleEdit');
                Route::put('{product}/vehicleUpdate', 'vehicleUpdate')->name('vehicleUpdate');
                Route::post('store-custom-table', 'storeCustomTable')->name('storeCustomTable');
                Route::post('store-default-table', 'storeDefaultTable')->name('storeDefaultTable');
                Route::get('approvals','approvals')->name('approvals');
                Route::put('approvalVehicle/{vehicle}','approvalVehicle')->name('approvalVehicle');
            });

            Route::prefix('{vehicle}')->group(function () {
                Route::controller(DescriptionController::class)->prefix('descriptions')->name('description.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                });

                Route::controller(GalleryController::class)->prefix('galleries')->name('gallery.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::delete('{gallery}', 'destroy')->name('delete');
                });
            });
        });
    });
});

// public vehicle view:
Route::controller(VehicleController::class)->group(function () {
    Route::get('{product}/view', 'view')->name('view');
    Route::get('stock-list', 'stockList')->name('stockList');
});
