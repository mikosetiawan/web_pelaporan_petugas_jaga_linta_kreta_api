<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '081234567890',
                'address' => 'Alamat Admin',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas 1',
                'email' => 'petugas1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'petugas',
                'phone' => '082345678901',
                'address' => 'Alamat Petugas',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas 2',
                'email' => 'petugas2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'petugas',
                'phone' => '082345678901',
                'address' => 'Alamat Petugas',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas 3',
                'email' => 'petugas3@example.com',
                'password' => Hash::make('password123'),
                'role' => 'petugas',
                'phone' => '082345678901',
                'address' => 'Alamat Petugas',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Koordinator Lapangan',
                'email' => 'korlap@example.com',
                'password' => Hash::make('password123'),
                'role' => 'korlap',
                'phone' => '083456789012',
                'address' => 'Alamat Korlap',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
