<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductSize;
use Faker\Generator as Faker;

$factory->define(ProductSize::class, function (Faker $faker) {
    $sizes = ['S', 'M', 'L', 'XL'];
    return [
        'size' => $sizes[rand(0, 3)],
        'quantity' => rand(10, 30),
        'product_id' => rand(1, Product::all()->count()),
    ];
});
