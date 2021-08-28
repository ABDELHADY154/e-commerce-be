<?php

use App\ClientAddress;
use Illuminate\Database\Seeder;

class ClientAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ClientAddress::class, 100)->create();
    }
}
