<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Log;

class ProductPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        Log::info($user);

        return true;
    }
}
