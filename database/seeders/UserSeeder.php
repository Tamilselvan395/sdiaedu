<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@srideekshaa.com'],
            [
                'name' => 'Sri Deekshaa Admin',
                'password' => bcrypt('Srideekshaa@2024!'),
                'email_verified_at' => now(),
            ]
        );
    }
}
