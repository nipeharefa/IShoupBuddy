<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Log;

class UserPolicy
{
    use HandlesAuthorization;


    public function updateSendiri(User $user, User $i) {
        return $user->id == $i->id;
    }
}
