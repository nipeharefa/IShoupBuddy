<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = ['product_vendor_id', 'quantity', 'price'];

    public function Cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function ProductVendor()
    {
        return $this->belongsTo(ProductVendor::class);
    }
}
