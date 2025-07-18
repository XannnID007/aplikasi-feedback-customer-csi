<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin Dimsum BOS',
            'email' => 'superadmin@dimsumbos.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // Create Regular Admin
        User::create([
            'name' => 'Admin Dimsum BOS',
            'email' => 'admin@dimsumbos.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}
