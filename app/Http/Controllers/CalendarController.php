<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentRepeat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $appointments = Appointment::with('training')->whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)->get();

            $appointmentRepeats = AppointmentRepeat::with('appointment')->whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)->get();

            $data = $appointments->merge($appointmentRepeats);


            $collection = $data->map(function ($item) {
                $title = empty($item->name) ? $item->appointment->name : $item->name;

                if (get_class($item) == 'App\Models\Appointment') {
                    $title = $item->name . ' - ტრენინგი: ' . $item->training->name;
                    $appointment_id = $item->id;
                } else {
                    $title = $item->appointment->name . ' - ტრენინგი: ' . $item->appointment->training->name;
                    $appointment_id = $item->appointment_id;
                }

                return [
                    'id' => $appointment_id,
                    'start' => $item->start_date,
                    'end' => $item->end_date,
                    'title' => $title,
                    'appointment_link' => route('admin.appointments.registeredCustomers', $appointment_id),
                    // 'description' => $item->html_link,
                    // 'meet_link' => $item->meet_link,
                    'color' => $item->color,
                ];
            });


            return response()->json($collection);
        }


        return view('admin.calendar.index');
    }
}
