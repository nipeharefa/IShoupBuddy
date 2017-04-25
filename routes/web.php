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

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', 'Auth\LoginController@loginViaAjax');
    Route::post('register', 'Auth\RegisterController@registerViaAjax');
    Route::delete('logout', 'Auth\LoginController@logout');
});


Route::group(['prefix' => 'me'], function() {

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

Route::get('/home', 'HomeController@index');

Route::resource('product', 'ProductController',
	['only' => ['show']]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::resource('product', 'ProductController',
        ['only' => ['index', 'create']]);
});
Route::get('image/{ratio}/{filename}', 'ImageController@renderImage');
