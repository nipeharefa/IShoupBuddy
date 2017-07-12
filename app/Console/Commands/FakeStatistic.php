<?php

namespace App\Console\Commands;

use App\Models\PriceStatistic;
use App\Models\ProductVendor;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Log;

class FakeStatistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:fakeprice
                            {--days= : Whether the job should be queued}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totalDays = $this->option('days') ?? 7;

        Log::info($totalDays);

        $pv = ProductVendor::get();

        $pv->each(function ($item) use ($totalDays) {
            $this->createFakeStats($item, $totalDays);
        });
    }

    protected function createFakeStats(ProductVendor $pv, $totalDays)
    {
        $carbon = Carbon::now();
        Log::info('BEGIN');

        for ($i = 1; $i <= $totalDays; $i++) {
            $d = $carbon->toDateString();
            $p = $pv->Statistic()->whereDate('updated_at', '=', $d)->first();

            if (!$p) {
                $a = new PriceStatistic(['harga' => $pv->harga, 'updated_at' => $d]);
                $pv->Statistic()->save($a);
            }
            $carbon->subDays(1);
        }
        Log::info('END');
    }
}
