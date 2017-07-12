<?php

namespace App\Models;

use App\Helpers\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use UserTrait;

    protected $fillable = ['user_id', 'product_id'];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
