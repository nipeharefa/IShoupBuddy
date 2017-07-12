<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class ProductVendorTransformer extends AbstractTransformer
{
    public function transformModel(Model $productV)
    {
        $secure = env('APP_ENV') == 'production';

        $arr = [
            'id'                => $productV->id,
            'name'              => $productV->Product->name,
            'picture_url'       => $this->generateUserPictureLinks($productV->Product->picture_url),
            'price'             => $productV->harga,
            'price_string'      => $this->formatRupiah($productV->harga),
            'barcode'           => $productV->Product->barcode,
            'vendor'            => VendorTransformer::transform($productV->Vendor),
        ];

        return $arr;
    }
}
