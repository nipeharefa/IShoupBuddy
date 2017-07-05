<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\ProductVendor;
use App\Models\Review;
use App\Models\Saldo;
use App\Observers\ProductVendorObserver;
use App\Observers\ReviewObserver;
use App\Observers\SaldoObserver;

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
