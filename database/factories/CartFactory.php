<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cart;
use App\Client;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    return [
        'quantity' => rand(2, 10),
        'total_price' => rand(500, 1000),
        'client_id' => rand(1, Client::all()->count()),
    ];
});
