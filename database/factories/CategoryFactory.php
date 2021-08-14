<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $categories = ['T-shirts', 'Shirts', 'Jeans'];
    return [
        'category' => $categories[rand(0, 2)],
        'brand_id' => rand(1, Brand::all()->count()),
    ];
});
