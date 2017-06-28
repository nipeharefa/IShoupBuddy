<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('search', 'SearchController@index');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::get('vendor/login', 'Auth\LoginVendorController@showLoginForm');

Route::resource('cart', 'CartController');

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::post('login', 'LoginController@loginViaAjax');
    Route::post('register', 'RegisterController@registerViaAjax');
    Route::delete('logout', 'LoginController@logout');

    Route::post('vendor/login', 'LoginVendorController@login');
    Route::post('vendor/register', 'RegisterVendorController@register');
    Route::delete('vendor/logout', 'LoginVendorController@logout')
        ->middleware(['auth']);
});

Route::group(['prefix' => 'me', 'middleware' => ['auth', 'member_only']], function() {

    Route::resource('/', 'MeController',
    	['only' => 'index', 'show']);
    Route::get('edit', 'MeController@edit');
    Route::get('change_password', 'MeController@change_password');

    Route::group(['namespace' => 'Me'], function() {
        Route::resource('transactions', 'TransactionController',
            ['only' => ['index', 'show']]);
        Route::resource('product_favorite', 'ProductFavoriteController',
            ['only' => ['index', 'show']]);
    });

});

Route::resource('product', 'ProductController',
	['only' => ['show']]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login');
    Route::group(['middleware' => ['auth', 'admin_only']], function() {
        Route::delete('logout', 'LoginController@logout');
        Route::get('/{any?}/{any2?}/{any3?}', 'TransactionController@index');
    });

});
Route::group(['prefix' => 'vendor', 'namespace' => 'Vendor', 'middleware' => ['auth']], function() {

    Route::resource('product', 'ProductController');
    Route::get('/{any?}/{any2?}/{any3?}', 'ProductController@index');

});


Route::get('image/{ratio}/{filename}', 'ImageController@renderImage');
