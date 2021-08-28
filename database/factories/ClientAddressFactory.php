<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\ClientAddress;
use Faker\Generator as Faker;

$factory->define(ClientAddress::class, function (Faker $faker) {
    $cityArr = ["Alexandria", "Cairo"];
    return [
        'name' => $faker->name,
        'city' => $cityArr[rand(0, 1)],
        'building_no' => rand(1, 100),
        "floor" => rand(1, 15),
        "appartment_no" => rand(1, 1000),
        "region" => $faker->streetName,
        "street_name" => $faker->streetName,
        "client_id" => rand(1, Client::all()->count()),
    ];
});
