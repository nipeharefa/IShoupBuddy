<?php

namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;

class ActiveUserTransformer extends AbstractTransformer {

    public function transformModel(Model $user){

        $arr = [
            "id"            =>  $user->id,
            "name"          =>  $user->name,
            "picture_url"   =>  $user->picture_url,
            "picture_links" =>  $this->generateUserPictureLinks($user->picture_url),
            "address"       =>  $user->address,
            "phone"         =>  $user->phone,
            "saldo"         =>  $user->Saldo->nominal ?? 0,
            "saldo_string"  =>  $user->Saldo->nominal
                                ? $this->formatRupiah($user->Saldo->nominal)
                                : 0,
            "role"          =>  $user->role,
            "langitude"     =>  $user->langitude,
            "longitude"     =>  $user->longitude
        ];


        return $arr;
    }

    protected function generateUserPictureLinks($filename) {

        $secure = $this->getProduction();

        if ($filename) {
            return [
                "small"     =>  url('/image/small', $filename, $secure),
                "large"     =>  url('/image/large', $filename, $secure)
            ];
        }

        return null;
    }
}
