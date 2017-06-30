<?php

namespace App\Observers;

use App\Models\Saldo;
use Exception;
use App\Events\SaldoNominalUpdated;

class SaldoObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function saved(Saldo $saldo)
    {
        $saldoEventClass = new SaldoNominalUpdated($saldo->User);

        event($saldoEventClass);
    }
}
