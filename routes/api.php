<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */


Route::post('image', 'ImageController@store');

Route::group(['prefix' => 'oauth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'PassportAuthController@login');
    Route::post('register', 'PassportAuthController@register');
});


Route::group(['namespace' => 'API'], function () {
    Route::resource('geo', 'GeoLocationController');
    Route::resource('compare', 'CompareController');
    Route::post('user/change_password', 'UserController@change_password')
        ->middleware('auth:api');

    Route::resource('user', 'UserController',
        ['only' => ['show']]);

    Route::resource('category', 'CategoryController',
        ['only' => ['index']]);

    Route::resource('promo', 'PromoController',
        ['only' => ['index']]);

    Route::get('product/barcode/{barcode}', 'ProductController@barcode');

    Route::resource('product', 'ProductController',
        ['only' => ['index', 'show']]);

    Route::resource('recommendation', 'RecommendationController',
        ['only' =>  ['index']]);

    Route::resource('review', 'ReviewController',
        ['only' => ['index', 'show']]);

    Route::resource('statistic', 'PriceStatisticController',
        ['only' => ['index', 'show']]);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::put('cart/{cart}/detail/{id}', 'CartDetailController@update');
        Route::delete('cart/{cart}/detail/{id}', 'CartDetailController@destroy');
        Route::resource('cart', 'CartController',
            ['only' =>  ['index', 'store', 'update', 'destroy']]);


        Route::resource('user', 'UserController',
            ['only' => ['index', 'store']]);

        Route::resource('wishlist', 'WishlistController',
            ['except' => ['create', 'edit', 'show']]);

        Route::resource('product', 'ProductController',
            ['only' => ['store', 'update']]);

        Route::resource('product-vendor', 'ProductVendorController',
            ['only' =>  ['index', 'store', 'destroy', 'update']]);

        Route::get('reviewcheck/check', 'ReviewController@checkReview');

        Route::resource('review', 'ReviewController',
            ['only' =>  ['store', 'update', 'destroy']]);

        Route::resource('saldo', 'SaldoController',
            ['only' =>  ['store', 'show','index']]);

        Route::post('product-vendor/restore/{id}', 'ProductVendorController@restore');

        Route::resource('transaction', 'TransactionController',
            ['only' =>  ['index', 'store']]);

        Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
            Route::resource('product', 'ProductController',
                ['only' =>  ['index', 'show']]);

            Route::resource('vendor', 'VendorController',
                ['only' =>  ['index', 'show']]);

            Route::resource('user', 'UserController',
                ['only' =>  ['index', 'show']]);

            Route::resource('transaction', 'TransactionController',
                ['except'   =>  ['create', 'edit']]);

            Route::resource('category', 'CategoryController');

            Route::post('transaction/{transaction}/approve', 'TransactionController@approve');
        });

        Route::group(['namespace' => 'Vendor', 'prefix' => 'vendor'], function () {
            Route::resource('product', 'ProductController');
            Route::resource('review', 'ReviewController',
                ['except' => ['create', 'edit']]);
        });
    });

    Route::resource('vendor', 'VendorController',
        ['only' => ['index', 'show']]);

    Route::post('vendor/activate', 'VendorController@activate');


    Route::group(['prefix' => 'me', 'middleware' => 'auth:api'], function () {
        Route::resource('/', 'MeController',
                ['only' => ['index']]);
    });
});
