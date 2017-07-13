<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Vendor extends User
{
    protected $table = 'users';

    protected $casts = [
        'confirmed' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', 2);
        });
    }

    public function ProductVendor()
    {
        return $this->hasMany(ProductVendor::class, 'vendor_id');
    }

    public function Review()
    {
        return $this->hasManyThrough(Review::class, ProductVendor::class);
    }

    public function Transaction()
    {
        return $this->hasManyThrough(TransactionDetail::class, ProductVendor::class);
    }
}
