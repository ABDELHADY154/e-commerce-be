<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class Client extends Authenticatable
{
    use SoftDeletes, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'image'
    ];
}
