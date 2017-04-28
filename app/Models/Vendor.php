<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class Vendor extends User
{

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', 2);
        });
    }

    public function ProductVendor() {

        return $this->hasMany(ProductVendor::class, 'vendor_id');
    }
}