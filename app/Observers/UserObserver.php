<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param User $user
     *
     * @return void
     */
    public function created(User $user)
    {
        $user->Saldo()->create(['nominal' => 0]);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param User $user
     *
     * @return void
     */
    public function deleting(User $user)
    {
        //
    }
}
