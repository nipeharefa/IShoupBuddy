<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class WishlistTransformer extends AbstractTransformer
{
    public function transformModel(Model $wish)
    {
        $arr = [
            'id'        => $wish->id,
            'product'   => ProductTransformer::transform($wish->Product),
        ];

        return $arr;
    }
}
