<?php

namespace Database\Seeders;

use App\Models\AppointmentHours;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = config('appointment.days');

        foreach($days as $day) {
            AppointmentHours::query()->updateOrCreate(['day' => $day],
                ['from' => '09:00', 'to' => '21:00', 'step' => 90],
            );
        }
    }
}
