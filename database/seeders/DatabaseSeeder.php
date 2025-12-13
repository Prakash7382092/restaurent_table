<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
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
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::factory()->create([
            'name' => 'vendor User',
            'email' => 'vendor@primooo.com',
            'password' => Hash::make('12345678'),
            'role' => 'vendor',
            'status' => 'active',
        ]);

        Vendor::factory()->create([
            'user_id' => 2,
            'store_name' => 'Vendor Store',
            'store_description' => 'This is a vendor store.',
            'store_location' => '123 Vendor St, City, Country',
            'store_contact' => '123-456-7890',
            'store_logo' => null,
            'store_banner' => null,
            'store_website' => 'https://vendorstore.example.com',
            'commission_rate' => 10.00,
            'is_approved' => true,
        ]);
    }
}
