<?php

use App\Http\Livewire\Search;
use App\Http\Livewire\ContactUs;
use App\Http\Livewire\HomeManager;
use App\Http\Livewire\AccessoryCard;
use App\Http\Livewire\DetailManager;
use App\Http\Livewire\UserDashboard;
use App\Http\Livewire\AccessoryOrder;
use App\Http\Livewire\VehicleManager;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PropertyManager;
use App\Http\Livewire\AccessoryManager;
use App\Http\Livewire\PropertyDetailManager;
use App\Http\Livewire\AccessoryDetailManager;
use App\Http\Livewire\FlatDetailManager;
use App\Http\Livewire\FlatManager;
use App\Http\Livewire\RentalService\RentalServiceComponent;
use App\Http\Livewire\RentalService\Category\RentalCarComponent;
use App\Http\Livewire\RentalService\Category\RentCarDetailComponent;

Route::name('home.')->group(function () {
    Route::get('/', HomeManager::class)->name('index');
    Route::get('/vehicles', VehicleManager::class)->name('vehicle');
    Route::get('/flat', VehicleManager::class)->name('flat');
    Route::get('/land', PropertyManager::class)->name('land');
    Route::get('/accessory', AccessoryManager::class)->name('accessory');
    Route::get('flat',FlatManager::class)->name('flat');
    Route::get('/search', Search::class)->name('search');

    Route::get('/vehicles/{slug}/details', DetailManager::class)->name('detail');
    Route::get('/property/{slug}/details', PropertyDetailManager::class)->name('property-detail');
    Route::get('/accessory/{slug}/details', AccessoryDetailManager::class)->name('accessory-detail');
    Route::get('/flat/{slug}/details', FlatDetailManager::class)->name('flat-detail');
    // Route::get('contact/us', ContactUs::class)->name('contactUs');

    /**
     * Auth middlewire
     */
    Route::middleware('auth:client')->group(function () {
        Route::get('/accessory/card', AccessoryCard::class)->name('accessory-card');
        Route::get('/accessory/order', AccessoryOrder::class)->name('accessory-order');
        Route::get('dashboard', UserDashboard::class)->name('user.dashboard');
    });

    /**
     * Rental Services and it's category route
     */
    Route::get('rental-service', RentalServiceComponent::class)->name('rental-service');
    Route::prefix('rental')->name('rental.')->group(function () {
        Route::prefix('category')->name('category.')->group(function () {
            Route::prefix('cars')->name('car.')->group(function () {
                Route::get('/', RentalCarComponent::class)->name('index');
                Route::get('{slug}/cars', RentCarDetailComponent::class)->name('detail');
            });
        });
    });
});


// @todo: client application routes
Route::name('client.')->group(function () {
    require __DIR__ . '/client/auth.php';
    require __DIR__ . '/client/base.php';
});

// @todo: admin application routes
Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__ . '/admin/auth.php';
    require __DIR__ . '/admin/base.php';
});

// @todo: merchant application routes
Route::prefix('merchant')->name('merchant.')->group(function () {
    require __DIR__ . '/merchant/auth.php';
    require __DIR__ . '/merchant/base.php';
});

Route::prefix('customer-care')->name('customer-care.')->group(function () {
    require __DIR__ . '/customer-care/auth.php';
    require __DIR__ . '/customer-care/base.php';
});
