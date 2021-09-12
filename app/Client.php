<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Overtrue\LaravelFavorite\Traits\Favoriter;
use Relative\LaravelExpoPushNotifications\Traits\HasPushTokens;

class Client extends Authenticatable
{
    use Favoriter, SoftDeletes, HasApiTokens, HasPushTokens;

    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'image'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function addresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
