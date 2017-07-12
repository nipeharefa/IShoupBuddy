<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'slug', 'description', 'picture_url'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Product()
    {
        return $this->hasMany(Product::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
