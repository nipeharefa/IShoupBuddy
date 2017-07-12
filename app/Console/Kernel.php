<?php

namespace App\Console;

use App\Console\Commands\FakeStatistic;
use App\Console\Commands\UpdateProductVendorPrice;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdateProductVendorPrice::class,
        FakeStatistic::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $update = $schedule->command('product:priceupdate');

        if (env('APP_ENV') == 'production') {
            $update->daily();
        } else {
            $update->everyMinute();
        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
