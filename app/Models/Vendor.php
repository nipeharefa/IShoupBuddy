<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class Vendor extends Model
{

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', 2);
        });
    }
}
