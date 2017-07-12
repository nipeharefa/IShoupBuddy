<?php

namespace App\Observers;

use App\Events\SaldoNominalUpdated;
use App\Models\Saldo;

class SaldoObserver
{
    /**
     * Listen to the User created event.
     *
     * @param User $user
     *
     * @return void
     */
    public function saved(Saldo $saldo)
    {
        $saldoEventClass = new SaldoNominalUpdated($saldo->User);

        event($saldoEventClass);
    }
}
