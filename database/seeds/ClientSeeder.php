<?php

use App\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => "client",
            'email' => "client@client.com",
            'password' => Hash::make('123123123'),
            'phone_number' => "0123123123",
        ]);
        // factory(Client::class, 100)->create();
    }
}
