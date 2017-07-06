<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionShippment extends Model
{
    protected $fillable = ['lat', 'lng', 'price', 'address', 'accepted_at'];


    public function Transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
