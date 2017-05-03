<?php

namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;

class ProductVendorTransformer extends AbstractTransformer {

    public function transformModel(Model $productV){

        $secure = env('APP_ENV') == "production";

        $arr = [
            "id"                =>  $productV->id,
            "name"              =>  $productV->Product->name,
            "picture_url"       =>  [
                "small"             =>  url('images/small', $productV->Product->picture_url, $secure),
                "medium"            =>  url('images/medium', $productV->Product->picture_url, $secure),
                "large"             =>  url('images/large', $productV->Product->picture_url, $secure)
            ],
            "price"             =>  $productV->harga,
            "price_string"      =>  $productV->harga,
            "barcode"           =>  $productV->Product->barcode,
            "vendor"            =>  VendorTransformer::transform($productV->Vendor)
        ];

        return $arr;
    }
}
