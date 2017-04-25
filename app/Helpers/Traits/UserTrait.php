<?php

namespace App\Helpers\Traits;

use App\Models\User;

trait UserTrait {

    public function User() {

        return $this->belongsTo(User::class);
    }
}
