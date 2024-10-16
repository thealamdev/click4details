<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('merchant.')->group(function () {
    require __DIR__ . '/api/merchant/base.php';
    require __DIR__ . '/api/merchant/auth.php';
});

Route::name('client.')->group(function () {
    require __DIR__ . '/api/client/base.php';
    require __DIR__ . '/api/client/auth.php';
});

Route::name('customer-care.')->group(function () {
    require __DIR__ . '/api/customer-care/base.php';
    require __DIR__ . '/api/customer-care/auth.php';
});
