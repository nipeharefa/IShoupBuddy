<?php


namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;

class ProductTransformer extends AbstractTransformer {

    public function transformModel(Model $product){

        $arr = [
            "id"            =>  $product->id,
            "name"          =>  $product->name,
            "category"      =>  $product->Category,
            "barcode"       =>  (double)$product->barcode,
            "picture_url"   =>  [
                "small" => url('/'),
                "medium" => url('/'),
                "large" => url('/'),
            ],
            "description"   =>  ""
        ];
        return $arr;
    }
}
