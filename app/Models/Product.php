<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'description', 'slug', 'barcode', 'picture_url', 'attributes'];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ProductVendor()
    {
        return $this->hasMany(ProductVendor::class);
    }

    public function ProductVendorTrashed()
    {
        return $this->ProductVendor()->withTrashed();
    }

    public function Review()
    {
        return $this->hasManyThrough(Review::class, ProductVendor::class);
    }

    public function Statistic()
    {
        return $this->hasManyThrough(PriceStatistic::class, ProductVendor::class);
    }

    public function alreadyInVendor()
    {
        return $this->ProductVendor->first();
    }
}
