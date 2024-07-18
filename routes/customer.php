<?php

use App\Http\Controllers\Customer\Address\CustomerAddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Cart\ShowOrderController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Customer\Payment\PaymentController;
use App\Http\Controllers\Customer\Payment\StripeController;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::resource('/showcart',ShowOrderController::class);
    Route::resource('/customer_address',CustomerAddressController::class);
    Route::resource('/payment',PaymentController::class);
    Route::resource('/stripe',StripeController::class);
});
