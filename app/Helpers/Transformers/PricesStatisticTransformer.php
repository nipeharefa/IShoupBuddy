<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class PricesStatisticTransformer extends AbstractTransformer
{
    public function transformModel(Model $statistic)
    {
        $arr = [
            "id"        =>  $statistic->id,
            "value"     =>  $statistic->harga,
            "date"      =>  $statistic->updated_at->toW3cString(),
            "vendor"    =>  $statistic->ProductVendor->vendor_id,
            "product"   =>  $statistic->ProductVendor->product_id
        ];
        return $arr;
    }
}
