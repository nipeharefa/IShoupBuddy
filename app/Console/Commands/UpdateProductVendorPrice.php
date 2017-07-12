<?php

namespace App\Console\Commands;

use App\Models\ProductVendor;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;

class UpdateProductVendorPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:priceupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Price Product';

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
        ProductVendor::get()->each(function ($pv) {
            try {
                $result = $pv->Statistic()->whereDay('created_at', date('d'))->firstOrFail();
                $result->harga = $pv->harga;
                $result->save();
                Log::info('Product Price Update');

                return;
            } catch (ModelNotFoundException $e) {
                $pv->Statistic()->create(['harga' => $pv->harga]);
                Log::info('Product Price Update');
            }
        });
    }
}
