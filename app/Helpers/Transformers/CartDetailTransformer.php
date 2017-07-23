<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class CartDetailTransformer extends AbstractTransformer
{
    public function transformModel(Model $cart)
    {
        $arr = [
            'id'            => $cart->id,
            'price'         => $cart->price,
            'price_string'  => $this->formatRupiah($cart->total),
            'product'       => collect(transform($cart->ProductVendor->Product))
                                ->except(['vendors']),
            'quantity'      => $cart->quantity,
            'satuan'        => $cart->ProductVendor->harga,
            'satuan_string' => $this->formatRupiah($cart->ProductVendor->harga)
        ];

        return $arr;
    }
}
