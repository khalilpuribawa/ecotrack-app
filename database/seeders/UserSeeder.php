<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin
        $admin = User::create([
            'name' => 'Admin EcoTrack',
            'email' => 'admin@ecotrack.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        UserPoint::create(['user_id' => $admin->id]);

        // 2. Buat User Biasa
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
        ]);
        UserPoint::create(['user_id' => $user1->id, 'total_points' => 150]);

        $user2 = User::create([
            'name' => 'Citra Lestari',
            'email' => 'citra@example.com',
            'password' => Hash::make('password'),
        ]);
        
        // 3. Gunakan Factory untuk membuat lebih banyak user
        User::factory()->count(10)->create()->each(function ($user) {
            UserPoint::create(['user_id' => $user->id, 'total_points' => rand(10, 200)]);
        });
    }
}