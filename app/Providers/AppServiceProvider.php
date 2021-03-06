<?php

namespace App\Providers;

use App\Models\ProductVendor;
use App\Models\Review;
use App\Models\Saldo;
use App\Models\User;
use App\Observers\ProductVendorObserver;
use App\Observers\ReviewObserver;
use App\Observers\SaldoObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        ProductVendor::observe(ProductVendorObserver::class);
        Saldo::observe(SaldoObserver::class);
        Review::observe(ReviewObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
