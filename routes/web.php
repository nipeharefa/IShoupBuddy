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
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Zend\Diactoros\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', 'Auth\LoginController@loginViaAjax');
    Route::post('register', 'Auth\RegisterController@registerViaAjax');
});

Route::group(['prefix' => 'oauth', 'namespace' => 'Auth'], function() {
    
    Route::post('login', 'PassportAuthController@login');
    Route::post('register', 'PassportAuthController@register');
});


Route::group(['prefix' => 'me', 'middleware' => 'auth'], function() {
    
    Route::resource('/', 'MeController',
    	['only' => 'index', 'show']);

});

Route::get('/home', 'HomeController@index');
