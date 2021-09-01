<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\ClientAddress;
use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
        'order_num' => $faker->randomNumber(),
        'client_id' => rand(1, Client::all()->count()),
        'address_id' => rand(1, ClientAddress::all()->count()),
        'status' => "ordered",
        'delivery' => $delivery = 30,
        'price' => $price = rand(300, 1000),
        'total_price' => ($price + $delivery)
    ];
});
