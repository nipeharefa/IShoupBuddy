<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class VendorTransformer extends AbstractTransformer {

    public function transformModel(Model $vendor){

        $arr = [
            "id"            =>  $vendor->id,
            "name"          =>  $vendor->name,
            "email"         =>  $vendor->email,
            "confirmed"     =>  (Boolean) $vendor->confirmed,
            "picture_url"   =>  $vendor->picture_url,
            "total_product" =>  $vendor->ProductVendor()->count(),
            "total_review"  =>  0,
            "lat"           =>  $vendor->latitude,
            "lng"           =>  $vendor->longitude
        ];

        return $arr;
    }
}
