<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentHours;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index() {
        $datePeriod = CarbonPeriod::create(now(), now()->addDays(6));

        $appointments = [];
        foreach($datePeriod as $date) {
            $dayName = $date->format('l');
            $appointmentsHours = AppointmentHours::where('day', $dayName)->first();
            // dd($appointmentsHours);
            $hours = $appointmentsHours->TimesPeriod;
            $currentAppoiments = Appointment::where('date', $date->toDateString())->pluck('time')->map(function($time){
                return $time->format('H:i');
            })->toArray();
            $availableHours = array_diff($hours, $currentAppoiments);

            $appointments[] = [
                'day_name' => $dayName,
                'date' => $date->format('d M'),
                'full_date' => $date->format('Y-m-d'),
                'off' => $appointmentsHours->off,
                'appointment_hours' => $hours,
                'reserved_hours' => $currentAppoiments,
                'available_hours' => $availableHours,
                'off' => $appointmentsHours->off
            ];
            // dd($appointments);
        }
        return view('appointments.reserve', compact('appointments'));
    }

    public function reserve(Request $request) {
        $data = $request->merge(['user_id' => auth()->id()])->toArray();
        Appointment::create($data);
        // return back();
        return response()->json(['success'=>'Successfully']);
    }
}
