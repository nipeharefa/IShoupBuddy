<?php


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
    Route::get('testCompare', 'CompareController@compare');
    Route::resource('geo', 'GeoLocationController');
    Route::resource('compare', 'CompareController');
    Route::post('user/change_password', 'UserController@change_password')
        ->middleware('auth:api');

    Route::get('user/{user}/transactions', 'UserController@getUserTransactions');
    Route::get('user/{user}/saldo/transactions', 'UserController@getUserSaldoTransactions');
    Route::get('user/{user}/review/total', 'UserController@getTotalReview');
    Route::get('user/{user}/review', 'UserController@getReviewAction');
    Route::resource('user', 'UserController',
        ['only' => ['show']]);

    Route::resource('category', 'CategoryController',
        ['only' => ['index', 'update']]);

    Route::resource('promo', 'PromoController',
        ['only' => ['index']]);

    Route::get('product/{product}/group-rating', 'ProductController@getGroupRating');
    Route::get('product/barcode/{barcode}', 'ProductController@barcode');

    Route::get('product/newest', 'ProductController@getNewestProduct');
    Route::get('product/trending', 'ProductController@getProductTrending');
    Route::resource('product', 'ProductController',
        ['only' => ['index', 'show']]);

    Route::resource('report', 'ReportController',
            ['only' => ['index']]);

    Route::resource('recommendation', 'RecommendationController',
        ['only' => ['index']]);

    Route::post('review/{review}/restore', 'ReviewController@restore');
    Route::resource('review', 'ReviewController',
        ['only' => ['index', 'show']]);

    Route::get('statistic/all', 'PriceStatisticController@all');
    Route::resource('statistic', 'PriceStatisticController',
        ['only' => ['index', 'show']]);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('checkout', 'CheckoutController');
        Route::post('cart/getSubTotal', 'CartController@getSubTotalCart');
        Route::put('cart/{cart}/detail/{id}', 'CartDetailController@update');
        Route::delete('cart/{cart}/detail/{id}', 'CartDetailController@destroy');
        Route::patch('cart-detail/{id}', 'CartDetailController@updateQuantity');
        Route::resource('cart', 'CartController',
            ['only' => ['index', 'store', 'update', 'destroy']]);

        Route::get('user/{user}/carts', 'UserController@getUserCart');
        Route::get('user/{user}/cartscounter', 'UserController@getUserCartCounter');
        Route::delete('user/unwishproduct/{product}', 'UserController@unWishProduct');
        Route::resource('user', 'UserController',
            ['only' => ['index', 'store']]);

        Route::resource('wishlist', 'WishlistController',
            ['except' => ['create', 'edit', 'show']]);

        Route::resource('product', 'ProductController',
            ['only' => ['store', 'update']]);

        Route::resource('report', 'ReportController',
            ['only' => ['store', 'update', 'destroy']]);

        Route::resource('product-vendor', 'ProductVendorController',
            ['only' => ['index', 'store', 'destroy', 'update']]);

        Route::get('reviewcheck/check', 'ReviewController@checkReview');

        Route::resource('review', 'ReviewController',
            ['only' => ['store', 'update', 'destroy']]);

        Route::resource('saldo', 'SaldoController',
            ['only' => ['store', 'show', 'index']]);

        Route::post('product-vendor/restore/{id}', 'ProductVendorController@restore');

        Route::post('transaction/{transaction}/upload', 'TransactionController@uploadPhotoTopup');
        Route::resource('transaction', 'TransactionController',
            ['only' => ['index', 'store']]);

        Route::post('transaction-shipment/postAcceptShipment/{id}',
            'TransactionShipmentController@postAcceptShipment');

        Route::resource('transaction-shipment', 'TransactionShipmentController',
            ['except'   => ['create', 'edit']]);

        Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
            Route::resource('product', 'ProductController',
                ['only' => ['index', 'show']]);

            Route::resource('review', 'ReviewController',
                ['only' => ['index', 'show']]);

            Route::resource('vendor', 'VendorController',
                ['only' => ['index', 'show']]);

            Route::resource('user', 'UserController',
                ['only' => ['index', 'show']]);

            Route::resource('transaction', 'TransactionController',
                ['except'   => ['create', 'edit']]);

            Route::resource('category', 'CategoryController');

            Route::post('transaction/{transaction}/approve', 'TransactionController@approve');
            Route::post('transaction/{transaction}/cancel', 'TransactionController@cancelTopUp');
        });

        Route::group(['namespace' => 'Vendor', 'prefix' => 'vendor'], function () {
            Route::resource('product', 'ProductController');
            Route::resource('review', 'ReviewController',
                ['except' => ['create', 'edit']]);
            Route::resource('sales', 'SaleController');
        });
    });

    Route::resource('vendor', 'VendorController',
        ['only' => ['index', 'show']]);

    Route::post('vendor/activate', 'VendorController@activate');
    Route::get('vendor/{vendor}/transactions',
        'VendorController@getVendorTransactions');

    Route::group(['prefix' => 'me', 'middleware' => 'auth:api'], function () {
        Route::resource('/', 'MeController',
                ['only' => ['index']]);
    });
});
