<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class DetailTransformer extends AbstractTransformer
{
    public function transformModel(Model $model)
    {
        $arr = [
            "id"                =>  $model->id,
            "name"              =>  $model->ProductVendor->Product->name,
            "quantity"          =>  $model->quantity,
            "harga"             =>  $model->harga,
            "harga_string"      =>  $this->formatRupiah($model->harga),
            "total"             =>  $model->total,
            "total_string"      =>  $this->formatRupiah($model->total),
            "product_vendor"    =>  transform($model->ProductVendor),
            "product"           =>  transform($model->ProductVendor->Product),
        ];

        return $arr;
    }
}
