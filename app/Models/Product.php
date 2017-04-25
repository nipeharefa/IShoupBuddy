<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'description', 'slug', 'barcode', 'picture_url'];


    public function Category() {

        return $this->belongsTo(Category::class);
    }
}
