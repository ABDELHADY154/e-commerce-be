<?php

use App\Brand;
use App\Gender;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Brand::class, 10)->create();
        // 'brand' => $faker->name,
        // 'brand_image' => 'default.jpeg',
        // 'brand_desc' => $faker->text,
        // 'gender_id' => rand(1, Gender::all()->count())

        Brand::create([
            'brand' => 'Hollister',
            'brand_image' => 'hollister.jpeg',
            'brand_desc' => null,
            'gender_id' => 1
        ]);
        Brand::create([
            'brand' => 'Hollister',
            'brand_image' => 'hollister.jpeg',
            'brand_desc' => null,
            'gender_id' => 2
        ]);
        Brand::create([
            'brand' => 'Calvin Klein',
            'brand_image' => 'ck.jpeg',
            'brand_desc' => null,
            'gender_id' => 1
        ]);
    }
}
