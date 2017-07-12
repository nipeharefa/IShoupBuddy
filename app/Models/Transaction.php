<?php

namespace App\Models;

use App\Helpers\Traits\UserTrait;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use UserTrait;
    protected $fillable = ['user_id', 'nominal', 'status', 'debit_credit'];

    public function transactable()
    {
        return $this->morphTo();
    }

    public function Detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function Saldo()
    {
        return $this->transactable()->belongsTo(Saldo::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function TransactionShippment()
    {
        return $this->hasOne(TransactionShippment::class);
    }
}
