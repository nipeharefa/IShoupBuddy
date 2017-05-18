<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_vendor_id', 'quantity', 'harga'];


    public function ProductVendor() {

        return $this->belongsTo(ProductVendor::class);
    }
}
