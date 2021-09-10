<?php

use App\Ad;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ad::create([
            'image' => 'p1.jpeg',
        ]);

        Ad::create([
            'image' => 'p2.jpeg',
        ]);

        Ad::create([
            'image' => 'p3.jpeg',
        ]);

        Ad::create([
            'image' => 'p4.jpeg',
        ]);
    }
}
