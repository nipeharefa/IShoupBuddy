<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'nominal', 'status'];

    public function transactable()
    {
        return $this->morphTo();
    }
}
