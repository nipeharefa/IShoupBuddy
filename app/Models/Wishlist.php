<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Traits\UserTrait;
use App\Helpers\Traits\ProductTrait;

class Wishlist extends Model
{
    use UserTrait;

    public function Product() {

        return $this->belongsTo(Product::class);
    }
}
