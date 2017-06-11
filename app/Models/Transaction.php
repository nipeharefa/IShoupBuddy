<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\UserTrait;

class Transaction extends Model
{
    use UserTrait;
    protected $fillable = ['user_id', 'nominal', 'status'];

    public function transactable()
    {
        return $this->morphTo();
    }

    public function Detail() {

        return $this->hasMany(TransactionDetail::class);
    }

    public function Saldo() {

        return $this->transactable()->belongsTo(Saldo::class);
    }

    public function User() {

        return $this->belongsTo(User::class);
    }
}
