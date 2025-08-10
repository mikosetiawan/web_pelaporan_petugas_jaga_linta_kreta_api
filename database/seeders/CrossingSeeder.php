<?php

namespace Database\Seeders;

use App\Models\Crossing;
use Illuminate\Database\Seeder;

class CrossingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Crossing::insert([
            [
                'code' => 'CR001',
                'name' => 'Perlintasan A',
                'location' => 'Jl. Raya Utama KM 10',
                'status' => 'active',
                'latitude' => '-6.200000',
                'longitude' => '106.816666',
                'description' => 'Perlintasan aktif dengan palang pintu otomatis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CR002',
                'name' => 'Perlintasan B',
                'location' => 'Jl. Veteran No. 5',
                'status' => 'inactive',
                'latitude' => '-6.300000',
                'longitude' => '106.816666',
                'description' => 'Perlintasan tidak aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CR003',
                'name' => 'Perlintasan C',
                'location' => 'Jl. Merdeka Barat',
                'status' => 'active',
                'latitude' => '-6.250000',
                'longitude' => '106.800000',
                'description' => 'Perlintasan dengan petugas jaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
