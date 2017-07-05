<?php

namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;

class ActiveUserTransformer extends AbstractTransformer {

    public function transformModel(Model $user){

        $saldo = $user->Saldo->nominal ?? null;

        $arr = [
            "id"            =>  $user->id,
            "name"          =>  $user->name,
            "picture_url"   =>  $user->picture_url,
            "email"         =>  $user->email,
            "picture_links" =>  $this->generateUserPictureLinks($user->picture_url),
            "address"       =>  $user->address,
            "phone"         =>  $user->phone,
            "saldo"         =>  $saldo ?? 0,
            "saldo_string"  =>  $saldo
                                ? $this->formatRupiah($user->Saldo->nominal ?? 0)
                                : 0,
            "role"          =>  $user->role,
            "latitude"     =>  $user->latitude,
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
