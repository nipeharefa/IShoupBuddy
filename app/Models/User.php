<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{

    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'confirmed',
        'role', 'picture_url', 'address', "longitude", "langitude"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function Wishlist() {

        return $this->hasMany(Wishlist::class);
    }

    public function isAdmin() :Boolean {

        return $this->role == 2;
    }

    public function Cart() {

        return $this->hasMany(Cart::class, 'identify_id');
    }

    public function Review() {

        return $this->hasMany(Review::class);
    }
}
