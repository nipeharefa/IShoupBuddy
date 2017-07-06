<?php

namespace App\Observers;

use Log;
use App\Models\ProductVendor;
use App\Models\PriceStatistic;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductVendorObserver
{
    public function saved(ProductVendor $pv)
    {
        try {
            $result = $pv->Statistic()->whereDay('created_at', date('d'))->firstOrFail();
            $result->harga = $pv->harga;
            $result->save();
            return;
        } catch (ModelNotFoundException $e) {
            $pv->Statistic()->create(['harga' => $pv->harga]);
        }
    }
}
