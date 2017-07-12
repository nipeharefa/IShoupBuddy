<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class CartTransformer extends AbstractTransformer
{
    public function transformModel(Model $cart)
    {
        $arr = [
            'id'            => $cart->id,
            'items'         => ProductVendorTransformer::transform($cart->ProductVendor),
            'total'         => $cart->harga,
            'total_string'  => $this->formatRupiah($cart->harga),
            'quantity'      => $cart->quantity,
        ];

        return $arr;
    }
}
