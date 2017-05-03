<?php

namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;

class ActiveUserTransformer extends AbstractTransformer {

    public function transformModel(Model $user){

        $secure = $this->getProduction();

        $arr = [
            "id"            =>  $user->id,
            "name"          =>  $user->name,
            "picture_url"   =>  $user->picture_url,
            "picture_links" =>  [
                "small"     =>  url('/image/small', $user->picture_url, $secure),
                "large"     =>  url('/image/large', $user->picture_url, $secure)
            ],
            "address"       =>  $user->address,
            "phone"         =>  $user->phone,
            "saldo"         =>  $user->saldo,
            "saldo_string"  =>  $user->saldo
        ];


        return $arr;
    }
}
