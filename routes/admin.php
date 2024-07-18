<?php

use App\Http\Controllers\Address\CitieController;
use App\Http\Controllers\Address\CountrieController;
use App\Http\Controllers\Address\StateController;
use App\Http\Controllers\Cart\OrderController;
use App\Http\Controllers\Categorie\CategorieController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomerProductController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::resource('/customer',CustomerController::class);
        Route::resource('/categorie', CategorieController::class);
        Route::resource('/product', ProductController::class);
        Route::resource('/create/cart',CustomerProductController::class)->name('show','cart');
        Route::resource('/orders',OrderController::class);
        Route::resource('/countries',CountrieController::class);
        Route::resource('/cities',CitieController::class);
        Route::resource('/states',StateController::class);
});
