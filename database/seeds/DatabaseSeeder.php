<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        // $this->call(ClientAddressSeeder::class);
        $this->call(GenderSeeder::class);
        // $this->call(BrandSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ProductSizeSeeder::class);
        // $this->call(ProductImageSeeder::class);
        // $this->call(CartSeeder::class);
        // $this->call(OrderSeeder::class);
        $this->call(AdSeeder::class);
    }
}
