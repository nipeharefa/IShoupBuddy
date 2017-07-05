<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Traits\UserTrait;
use App\Helpers\Traits\ProductTrait;

class Wishlist extends Model
{
    use UserTrait;

    protected $fillable = ['user_id', 'product_id'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
