<?php

namespace App\Helpers\Traits;

use App\Models\Product;

trait ProductTrait {

    public function Product() {

        return $this->belongsTo(Product::class);
    }
}
