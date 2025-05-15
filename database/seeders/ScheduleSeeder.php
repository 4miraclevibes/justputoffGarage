<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2025, 5, 1);
        $endDate = Carbon::create(2025, 5, 30);

        while ($startDate->lte($endDate)) {
            // Untuk setiap hari, buat slot dari jam 9 sampai 15 (3 sore)
            for ($hour = 9; $hour <= 15; $hour++) {
                Schedule::create([
                    'tanggal' => $startDate->copy()->setHour($hour)->setMinute(0)->setSecond(0),
                    'status' => true,
                    'is_libur' => false,
                ]);
            }
            $startDate->addDay();
        }
    }
}
