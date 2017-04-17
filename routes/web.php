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

Route::group(['prefix' => 'auth', 'middleware' => 'api'], function() {
    Route::post('login', 'Auth\LoginController@loginViaAjax');
    Route::post('register', 'Auth\RegisterController@registerViaAjax');
});

Route::group(['prefix' => 'oauth', 'namespace' => 'Auth'], function() {
    
    Route::post('login', 'PassportAuthController@login');
    Route::post('register', 'PassportAuthController@register');
    
});


Route::group(['prefix' => 'me'], function() {
    
    Route::resource('/', 'MeController',
    	['only' => 'index', 'show']);
    Route::get('edit', 'MeController@edit');

});

Route::get('/home', 'HomeController@index');

Route::resource('product', 'ProductController',
	['only' => ['show']]);
