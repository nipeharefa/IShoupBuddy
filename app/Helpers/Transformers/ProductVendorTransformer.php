<?php

namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;

class ProductVendorTransformer extends AbstractTransformer {

    public function transformModel(Model $productV){

        $arr = [
            "id"            =>  $productV->id,
            "name"          =>  $productV->Product->name,
            "price"         =>  $productV->harga,
            "price_string"  =>  $productV->harga,
            "barcode"       =>  $productV->Product->barcode,
            "vendor"        =>  VendorTransformer::transform($productV->Vendor)
        ];

        return $arr;
    }
}
