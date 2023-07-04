<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentHours extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTimesPeriodAttribute() {
        $times1 = CarbonInterval::minutes($this->step)->toPeriod($this->from, $this->to)->toArray();
        $from = Carbon::createFromFormat('H:i', "15:30");
        $to = Carbon::createFromFormat('H:i', "21:00");
        $times2 = CarbonInterval::minutes($this->step)->toPeriod($from, $to)->toArray();
        $combinedTimes = array_merge($times1, $times2);
        // dd($times);
        // 12:00 last appointment - from 12 to 13
        // 14:00, 15:00 - no appointments
        $excludedTimes = ['13:30', '15:00', '16:30', '18:00', '19:30', '21:00'];
        $times = array_filter($combinedTimes, function ($time) use ($excludedTimes) {
            return !in_array($time->format('H:i'), $excludedTimes);
        });
        asort($times);
        return array_map(fn($time) => $time->format('H:i'), $times);
    }
}
