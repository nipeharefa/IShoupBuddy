<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVendor extends Model
{
    protected $fillable = ['product_id', 'vendor_id', 'harga', 'status'];

    public function Vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
