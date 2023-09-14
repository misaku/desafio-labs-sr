<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@luizalabs.com',
            'password' => Hash::make('#luizaLabs123'),
            'email_verified_at' => now(),
            'remember_token' => 'default to test',
        ]);
    }
}
