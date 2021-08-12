<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use App\Gender;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'brand' => $faker->name,
        'brand_image' => 'default.jpeg',
        'brand_desc' => $faker->text,
        'gender_id' => rand(1, Gender::all()->count())
    ];
});
