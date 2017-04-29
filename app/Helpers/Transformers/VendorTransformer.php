<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class VendorTransformer extends AbstractTransformer {

    public function transformModel(Model $vendor){

        $arr = [
            "id"    =>  $vendor->id,
            "name"  =>  $vendor->name,
            "picture_url"   =>  $vendor->picture_url,
            "total_product" =>  $vendor->ProductVendor()->count(),
            "total_review"  =>  0
        ];

        return $arr;
    }
}
