<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Crossing;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil hanya user dengan role 'petugas'
        $users = User::where('role', 'petugas')->pluck('id')->toArray();
        $crossings = Crossing::pluck('id')->toArray();

        if (empty($users) || empty($crossings)) {
            $this->command->warn('Seeder dibatalkan: pastikan tabel users (dengan role petugas) dan crossings memiliki data.');
            return;
        }

        $shifts = ['pagi', 'siang', 'malam'];
        $statuses = ['planned', 'ongoing', 'completed'];

        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::today()->addDays(rand(0, 10));
            $shift = $shifts[array_rand($shifts)];

            [$start_time, $end_time] = match ($shift) {
                'pagi'  => ['06:00:00', '14:00:00'],
                'siang' => ['14:00:00', '22:00:00'],
                'malam' => ['22:00:00', '06:00:00'],
            };

            Schedule::create([
                'user_id'     => $users[array_rand($users)],
                'crossing_id' => $crossings[array_rand($crossings)],
                'date'        => $date,
                'start_time'  => $start_time,
                'end_time'    => $end_time,
                'shift'       => $shift,
                'status'      => $statuses[array_rand($statuses)],
            ]);
        }
    }
}
