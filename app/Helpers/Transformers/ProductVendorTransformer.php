<?php

namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;

class ProductVendorTransformer extends AbstractTransformer {

    public function transformModel(Model $productV){

        $arr = [
            "id"            =>  $productV->id,
            "price"         =>  $productV->harga,
            "price_string"  =>  $productV->harga,
            "vendor"        =>  $productV->Vendor
        ];

        return $arr;
    }
}
