<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentHourRequest;
use App\Models\AppointmentHours;
use Illuminate\Http\Request;

class AppointmentHoursController extends Controller
{
    public function index() {
        $appointmentHours = AppointmentHours::all();
        return view('appointments.appointments', compact('appointmentHours'));
    }

    public function update(AppointmentHourRequest $request) {
        AppointmentHours::upsert($request->validated()['data'], ['day']);

        return back();
    }
}
