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

Route::group(['prefix' => 'oauth', 'namespace' => 'Auth'], function() {
    Route::post('login', 'PassportAuthController@login');
    Route::post('register', 'PassportAuthController@register');
});

Route::group(['namespace' => 'API'], function() {

    Route::resource('user', 'UserController',
    	['only' => ['show']]);

    Route::resource('category', 'CategoryController',
        ['only' => ['index']]);

    Route::resource('product', 'ProductController',
        ['only' => ['index', 'show']]);

    Route::resource('vendor', 'VendorController',
        ['only' => ['index', 'show']]);

	Route::group(['middleware' => 'auth:api'], function () {

	    Route::resource('user', 'UserController',
            ['only' => ['index', 'update']]);

        Route::resource('wishlist', 'WishlistController',
	    	['except' => ['create', 'edit', 'show']]);

	});

    Route::group(['prefix' => 'me', 'middleware' => 'auth:api'], function() {

        Route::group(['namespace' => 'Me'], function() {

            Route::resource('transactions', 'TransactionController',
                ['only' => ['index', 'show']]);

            Route::resource('product_favorite', 'ProductFavoriteController',
                ['only' => 'index', 'show', 'destroy']);
        });
    });
});
