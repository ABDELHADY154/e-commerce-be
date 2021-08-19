<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductImage;
use Faker\Generator as Faker;

$factory->define(ProductImage::class, function (Faker $faker) {
    $images = ['p1.jpeg', 'p2.jpeg', 'p3.jpeg', 'p4.jpeg'];
    return [
        'image' => $images[rand(0, 3)],
        'product_id' => rand(1, Product::all()->count()),
    ];
});
