<?php

use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;

Route::controller(MasterController::class)->group(function () {

    Route::get('/', 'home')->name('home');
    Route::get('/item-shop', 'itemShop')->name('item.shop');
    Route::get('/item-cart', 'itemCart')->name('item.cart');
    Route::get('/item-details', 'itemDetails')->name('item.details');
    Route::get('/item-checkout', 'itemCheckout')->name('item.checkout');
    Route::get('/contact-us', 'contactUs')->name('contact.us');

    Route::get('/user-login', 'userLogin')->name('user.login');
    Route::get('/user-register', 'userRegister')->name('user.register');

    Route::post('/store-user-information', 'storeUserInformation')->name('store.user.information');

});
