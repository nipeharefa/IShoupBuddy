<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class UserTransformers extends AbstractTransformer {

    public function transformModel(Model $user){

        $opts = @$this->options;

        $arr = [
            "id"    =>  $user->id,
            "name"    =>  $user->name,
            "picture_url"    =>  $user->picture_url,
        ];

        if (isset($opts['show_email']) && $opts['show_email']) {

            $arr['email']   =  $user->email;
        }
        if (isset($opts['show_saldo']) && $opts['show_saldo']) {

            $arr['phone']   =  $user->phone;
        }

        if ($this->isRelationshipLoaded($user, 'Saldo')) {
            $saldo = $user->Saldo->nominal ?? 0;
            $arr['saldo'] = [
                "nominal"       =>  $saldo,
                "saldo_string"  =>  $this->formatRupiah($saldo),
                "history"       =>  null
            ];
        }

        return $arr;
    }

}
