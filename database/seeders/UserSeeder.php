<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        \App\Models\User::insert([
            'name' => 'Ajax',
            'email' => 'ajax@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$eT9YqXKL.N8vh6CjYypDteu0eDu1GfefWsse0Fd8f0Dw8p8m83D7m', // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::insert([
            'name' => 'Azura',
            'email' => 'azura@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$eT9YqXKL.N8vh6CjYypDteu0eDu1GfefWsse0Fd8f0Dw8p8m83D7m', // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(8)->create();
    }
}
