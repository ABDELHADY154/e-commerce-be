<?php

use App\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::create([
            'gender_name' => 'Men'
        ]);

        Gender::create([
            'gender_name' => 'Women'
        ]);
    }
}
