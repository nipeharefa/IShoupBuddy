<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceStatistic extends Model
{
    protected $fillable = ['harga', 'updated_at'];

    public function ProductVendor()
    {
        return $this->belongsTo(ProductVendor::class);
    }
}
