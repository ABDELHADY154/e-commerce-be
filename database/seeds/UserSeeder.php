<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mohamed Abdelhady',
            'email' => 'admin@beamstore.net',
            'email_verified_at' => now(),
            'password' => Hash::make('123123123'), // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Mohamed Emad',
            'email' => 'mohamedemad@beamstore.net',
            'email_verified_at' => now(),
            'password' => Hash::make('MEbeamStore'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
