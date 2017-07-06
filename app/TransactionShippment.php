<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionShippment extends Model
{
    protected $fillable = ['lat', 'lng', 'price', 'address'];


    public function Transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
