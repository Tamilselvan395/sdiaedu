<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Developer (Full access)
        User::updateOrCreate(
            ['email' => 'developer@sdiaedu.com'],
            [
                'name' => 'SDIA Developer',
                'password' => bcrypt('sdia@8580'),
                'role' => UserRole::Developer,
                'email_verified_at' => now(),
            ]
        );

        // 2. Super Admin (Full access)
        User::updateOrCreate(
            ['email' => 'superadmin@sdiaedu.com'],
            [
                'name' => 'SDIA Super Admin',
                'password' => bcrypt('sdia@8580'),
                'role' => UserRole::SuperAdmin,
                'email_verified_at' => now(),
            ]
        );

        // 3. Admin (Enquiry Only)
        User::updateOrCreate(
            ['email' => 'admin@sdiaedu.com'],
            [
                'name' => 'SDIA Enquiry Admin',
                'password' => bcrypt('sdia@8580'),
                'role' => UserRole::Admin,
                'email_verified_at' => now(),
            ]
        );
    }
}
