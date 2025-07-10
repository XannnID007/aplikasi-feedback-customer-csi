<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Dimsum BOS',
            'email' => 'admin@dimsumbos.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
        ]);
    }
}
