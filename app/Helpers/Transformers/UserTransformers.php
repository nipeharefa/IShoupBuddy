<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class UserTransformer extends AbstractTransformer {

    public function transformModel(Model $user){

        $arr = [
            "id"    =>  $user->id,
            "name"    =>  $user->name,
            "picture_url"    =>  $user->picture_url,
        ];

        return $arr;
    }
}
