<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Traits\UserTrait;

class Saldo extends Model
{
    use UserTrait;

    protected $fillable = ['nominal'];

    public function Transaction () {
        return $this->morphMany(Transaction::class, 'transactable');
    }

    public function getUnPaid() {

        return $this->Transaction()->where('status', false)->get();
    }
}
