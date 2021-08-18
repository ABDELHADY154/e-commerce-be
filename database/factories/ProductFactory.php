<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'desc' => $faker->text,
        'price' => $price = rand(300, 1000),
        'quantity' => rand(20, 40),
        'category_id' => rand(1, Category::all()->count()),
        'discount' => $discount = rand(0, 100),
        'total_price' => $price - ($price * ($discount / 100)),
        'sale' => $discount == 0 ? false : true
    ];
});
