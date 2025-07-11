<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the user already exists to avoid duplication on re-seeding
        if (!User::where('email', 'admin@genba.aradenta.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@genba.aradenta.com',
                'password' => Hash::make('password'), // You should change this for production
                'role' => 'admin',
                'department' => 'management',
                'email_verified_at' => now(),
            ]);
        }
    }
}