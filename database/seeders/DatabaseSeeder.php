<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        // Note: `User` model now uses the `password` cast to hash automatically,
        // so pass the plain password here to avoid double-hashing.
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@primooo.com',
            'password' => 'password',
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
