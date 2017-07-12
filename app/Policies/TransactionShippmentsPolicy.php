<?php

namespace App\Policies;

use App\Models\TransactionShippment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionShippmentsPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the transactionShippment.
     *
     * @param \App\User                 $user
     * @param \App\TransactionShippment $transactionShippment
     *
     * @return mixed
     */
    public function view(User $user, TransactionShippment $transactionShippment)
    {
        //
    }

    /**
     * Determine whether the user can create transactionShippments.
     *
     * @param \App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the transactionShippment.
     *
     * @param \App\User                 $user
     * @param \App\TransactionShippment $transactionShippment
     *
     * @return mixed
     */
    public function update(User $user, TransactionShippment $transactionShippment)
    {
        // return false;
        if ($user->role === 0) {
            return true;
        }

        return $user->id === $transactionShippment->Transaction->User->id;
    }

    /**
     * Determine whether the user can delete the transactionShippment.
     *
     * @param \App\User                 $user
     * @param \App\TransactionShippment $transactionShippment
     *
     * @return mixed
     */
    public function delete(User $user, TransactionShippment $transactionShippment)
    {
        //
    }
}
