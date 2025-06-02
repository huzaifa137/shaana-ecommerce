<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;

Route::controller(MasterController::class)->group(function () {

    Route::group(['middleware' => ['CustomerAuth']], function () {

        Route::get('/item-shop', 'itemShop')->name('item.shop');
        Route::get('/item-cart', 'itemCart')->name('item.cart');
        Route::get('/item-details', 'itemDetails')->name('item.details');
        Route::get('/item-checkout', 'itemCheckout')->name('item.checkout');
        Route::get('/contact-us', 'contactUs')->name('contact.us');

        Route::get('/product-item/{id}', 'productItem')->name('product.item');
        Route::get('/user-login', 'userLogin')->name('user.login');
        Route::get('/user-register', 'userRegister')->name('user.register');
        Route::get('/user-profile', 'userProfile')->name('user.profile');

    });

    Route::post('user-store-new-password', 'store_new_password')->name('user-store-new-password');
    Route::post('/store-user-information', 'storeUserInformation')->name('store.user.information');
    Route::post('/user-login-credentials', 'userloginCredentials')->name('user.login.credentials');
    Route::post('/update-user-profile', 'updateProfile')->name('profile.update');
    Route::post('user-generate-forgot-password-link', 'generateForgotPasswordLink')->name('user-generate-forgot-password-link');

    Route::get('/', 'home')->name('home');
    Route::get('password/reset/{id}', 'createNewPassword')->name('password/reset');
    Route::get('/user-forgot-password', 'userForgotPassword')->name('user.forgot.password');

});

Route::controller(CustomerController::class)->group(function () {

    Route::group(['prefix' => '/customer'], function () {

        Route::group(['middleware' => ['CustomerAuth']], function () {
            Route::get('/dashboard', 'customerDashboard')->name('customer.dashboard');
        });

    });

    Route::get('/customer-logout', 'customerLogout')->name('customer.logout');

});
