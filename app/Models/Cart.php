<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['vendor_id', 'quantity', 'harga'];

    public function User()
    {
        return $this->belongsTo(User::class, 'identify_id');
    }

    public function Vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function ProductVendor()
    {
        return $this->belongsTo(ProductVendor::class);
    }

    public function Detail()
    {
        return $this->hasMany(CartDetail::class);
    }
}
