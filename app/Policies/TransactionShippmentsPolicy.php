<?php

namespace App\Policies;

use App\User;
use App\TransactionShippment;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionShippmentsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the transactionShippment.
     *
     * @param  \App\User  $user
     * @param  \App\TransactionShippment  $transactionShippment
     * @return mixed
     */
    public function view(User $user, TransactionShippment $transactionShippment)
    {
        //
    }

    /**
     * Determine whether the user can create transactionShippments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the transactionShippment.
     *
     * @param  \App\User  $user
     * @param  \App\TransactionShippment  $transactionShippment
     * @return mixed
     */
    public function update(User $user, TransactionShippment $transactionShippment)
    {
        if ($user->role === 0) {
            return true;
        }
        return $user->id === $transactionShippment->Transaction->User->id;
    }

    /**
     * Determine whether the user can delete the transactionShippment.
     *
     * @param  \App\User  $user
     * @param  \App\TransactionShippment  $transactionShippment
     * @return mixed
     */
    public function delete(User $user, TransactionShippment $transactionShippment)
    {
        //
    }
}
