<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = ['product_vendor_id', 'quantity', 'transaction_id', 'harga'];

    public function ProductVendor() {

        return $this->belongsTo(ProductVendor::class);
    }
}
