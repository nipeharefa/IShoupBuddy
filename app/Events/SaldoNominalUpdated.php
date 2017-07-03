<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Saldo;
use App\Models\User;
use App\Helpers\Traits\RupiahFormated;

class SaldoNominalUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels, RupiahFormated;


    public $saldo = [];

    protected $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->preNominal($user->Saldo);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('saldo.user.'.$this->user->id);
    }

    public function broadcastAs()
    {
        return 'saldo.updated';
    }

    protected function preNominal(Saldo $saldo)
    {
        $saldo = $saldo->nominal ?? 0;

        $response = [
            "message"       =>  null,
            "saldo"         =>  $saldo,
            "saldo_string"  =>  $this->formatRupiah($saldo),
            "status"        =>  "OK"
        ];

        $this->saldo = $response;
    }
}
