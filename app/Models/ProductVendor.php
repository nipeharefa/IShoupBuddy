<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVendor extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'vendor_id', 'harga', 'status'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function Statistic()
    {
        return $this->hasMany(PriceStatistic::class);
    }

    public function Reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function TransactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
