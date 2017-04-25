<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];
    public function Product() {

        return $this->hasMany(Product::class);
    }
}
