<?php

namespace App\Http\Controllers;

use DateTime;
use Throwable;
use App\Models\Office;
use App\Models\Customer;
use App\Models\Training;
use App\Models\Appointment;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\AppointmentRepeat;
use Illuminate\Support\Facades\DB;
use App\Models\AppointmentCustomer;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Appointment::with(['training', 'customers'])->withCount('customers');

        if ($request->sort == 'customers') {
            $objects->orderBy('customers_count', 'desc');
        }
        if ($request->sort == 'customers-') {
            $objects->orderBy('customers_count', 'asc');
        }

        if ($request->sort == 'created_at') {
            $objects->orderBy('created_at', 'desc');
        }
        if ($request->sort == 'created_at-') {
            $objects->orderBy('created_at', 'asc');
        }

        if ($request->sort == 'start_date') {
            $objects->orderBy('start_date', 'desc');
        }
        if ($request->sort == 'start_date-') {
            $objects->orderBy('start_date', 'asc');
        }

        if (!empty($request->training_id)) {
            $objects->where('training_id', $request->training_id);
        };

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);

        $trainings = Training::orderBy('id', 'desc')->get();

        return view('admin.appointments.index', compact('objects', 'trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainings = Training::orderBy('id', 'desc')->get();

        return view('admin.appointments.create', compact('trainings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        //check if appointment on same time already exists
        $start_date = $request->start_date;
//        $end_date = date("Y-m-d H:i", strtotime("$start_date + $request->duration Hour"));
        $end_date = $request->end_date;
        if (strtotime($end_date) <= strtotime($start_date)) {
            return redirect()->back()->withInput()->with("error", "End date must be after start date.");
        }

//        check if start and end dates are different
//        if (date("Y-m-d", strtotime($start_date)) != date("Y-m-d", strtotime($end_date))) {
//            return redirect()->back()->withInput()->with("error", "Appointment start and end date needs to be same");
//        }

        //check if record exists on same date

        $appointment = Appointment::inFuture()->where(function ($q) use ($start_date, $end_date) {
            $q->whereDate('start_date', date("Y-m-d", strtotime($start_date)))
                ->orWhereDate('end_date', date("Y-m-d", strtotime($end_date)));
        })->first();

        //check if hours are crossed
        if ($appointment) {
            $requestStartDate = $start_date;
            $requestEndDate = $end_date;
            $startDate = $appointment->start_date;
            $endDate = $appointment->end_date;

            if (($requestStartDate >= $startDate) && ($requestStartDate <= $endDate) || ($requestEndDate >= $startDate) && ($requestEndDate <= $endDate)) {
                return redirect()->back()->withInput()->with("error", "On the same Date Appointment Already exists. Appointment Id: $appointment->id");
            }
        }



        $training = Training::where('id', $request->training_id)->first();

        if (!$training) {
            return redirect()->back()->withInput()->withInput()->with("error", "ტრენინგი ვერ მოიძებნა");
        }

        //check if training has tests and if not throw error
        if (count($training->tests) < 1) {
            return redirect()->back()->withInput()->withInput()->with("error", "ტრენინგს არ აქვს ტესტები, გთხოვთ დაამატოთ ტრენინგის ტესტები");
        }

        //check number of training tests and point to pass and if they are wrong throw error

        if ($training->point_to_pass > count($training->tests)) {
            return redirect()->back()->withInput()->withInput()->with("error", "ჩასაბარებელი ქულა აღემატება ტრენინგის ტესტების რაოდენობას");
        }

        $object = new Appointment();
        $object->training_id = $request->training_id;
        $object->name = $request->name;
        $object->start_date = $request->start_date;
        $object->end_date = $end_date;
        $object->repeat = $request->repeat;
        $object->save();

        //save appointment repeat record
        if (!empty($request->repeat)) {
            $appointmentRepeat = new AppointmentRepeat();
            $appointmentRepeat->appointment_id = $object->id;
            $month = $object->repeat;
            $start_date = date("Y-m-d H:i:s", strtotime("+$month month", strtotime($object->start_date)));
            $end_date = date("Y-m-d H:i:s", strtotime("+$month month", strtotime($object->end_date)));
            $appointmentRepeat->start_date = $start_date;
            $appointmentRepeat->end_date = $end_date;
            $appointmentRepeat->save();
        }

        return redirect(route('admin.appointments.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $object)
    {
        $trainings = Training::orderBy('id', 'desc')->get();

        return view('admin.appointments.edit', compact('object', 'trainings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, Appointment $object)
    {
        //check if appointment can be updated
        if (!$object->canBeEdited()) {
            return redirect()->back()->withInput()->with("error", "Appointment can't be updated Anymore");
        }
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (strtotime($end_date) <= strtotime($start_date)) {
            return redirect()->back()->withInput()->with("error", "End date must be after start date.");
        }

//        $end_date = date("Y-m-d H:i", strtotime("$start_date + $request->duration Hour"));


        //check if start and end dates are different
//        if (date("Y-m-d", strtotime($start_date)) != date("Y-m-d", strtotime($end_date))) {
//            return redirect()->back()->withInput()->with("error", "Appointment start and end date needs to be same");
//        }

        $appointment = Appointment::inFuture()->where('id', '!=', $object->id)->where(function ($q) use ($start_date, $end_date) {
            $q->whereDate('start_date', date("Y-m-d", strtotime($start_date)))
                ->orWhereDate('end_date', date("Y-m-d", strtotime($end_date)));
        })->first();

        //check if hours are crossed
        if ($appointment) {
            $requestStartDate = $start_date;
            $requestEndDate = $end_date;
            $startDate = $appointment->start_date;
            $endDate = $appointment->end_date;

            if (($requestStartDate >= $startDate) && ($requestStartDate <= $endDate) || ($requestEndDate >= $startDate) && ($requestEndDate <= $endDate)) {
                return redirect()->back()->withInput()->with("error", "On the same Date Appointment Already exists. Appointment Id: $appointment->id");
            }
        }

        $object->training_id = $request->training_id;
        $object->name = $request->name;
        $object->start_date = $request->start_date;
        $object->end_date = $end_date;
        $object->repeat = $request->repeat;
        $object->save();

        //save appointment repeat record
        if (!empty($request->repeat)) {
            $appointmentRepeat = AppointmentRepeat::where('appointment_id', $object->id)->first();
            $month = $object->repeat;
            $start_date = date("Y-m-d H:i:s", strtotime("+$month month", strtotime($object->start_date)));
            $end_date = date("Y-m-d H:i:s", strtotime("+$month month", strtotime($object->end_date)));
            $appointmentRepeat->start_date = $start_date;
            $appointmentRepeat->end_date = $end_date;
            $appointmentRepeat->save();
        }

        return redirect(route('admin.appointments.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function repeatView(Request $request)
    {
        $objects = Appointment::inPast()->with(['training', 'customers'])->withCount('customers')->where('repeated_status', 2)->whereNotNull('repeat');

        if ($request->sort == 'customers') {
            $objects->orderBy('customers_count', 'desc');
        }
        if ($request->sort == 'customers-') {
            $objects->orderBy('customers_count', 'asc');
        }

        if ($request->sort == 'created_at') {
            $objects->orderBy('created_at', 'desc');
        }
        if ($request->sort == 'created_at-') {
            $objects->orderBy('created_at', 'asc');
        }

        if ($request->sort == 'start_date') {
            $objects->orderBy('start_date', 'desc');
        }
        if ($request->sort == 'start_date-') {
            $objects->orderBy('start_date', 'asc');
        }

        if (!empty($request->training_id)) {
            $objects->where('training_id', $request->training_id);
        };

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%');
        };

        $objects = $objects->orderBy('repeat', 'asc')->paginate(10);


        $trainings = Training::orderBy('id', 'desc')->get();

        return view('admin.appointments.repeat', compact('objects', 'trainings'));
    }

    public function repeat(Appointment $object)
    {
        //duplicate appointment
        $appointment = new Appointment();
        $appointment->training_id = $object->training_id;
        $appointment->name = $object->name;
        $appointment->repeat = $object->repeat;
        $appointment->start_date = $object->repeatStartDate();
        $appointment->end_date = $object->repeatEndDate();
        $appointment->save();

        //register appointment customers
        foreach ($object->customers as $customer) {
            $appointmentCUstomer = new AppointmentCustomer();
            $appointmentCUstomer->customer_id = $customer->id;
            $appointmentCUstomer->appointment_id = $appointment->id;
            $appointmentCUstomer->save();
        }

        //make  appointment as repeated
        $object->repeated_status = Appointment::REPEAT_STATUS_REPEATED;
        $object->save();

        return redirect()->back()->with('success', 'record created successfully');
    }


    public function registerCustomers(Request $request, Appointment $object)
    {

        if (!is_array($request->customer_ids)) {
            return redirect()->back()->with('error', 'You have to select at least one customer');
        }
        //check appointment maximum number
        // $max_appointment_participants = config('meta.max_appointment_participants');
        // if (count($object->customers) + count($request->customer_ids)  >= $max_appointment_participants) {
        //     return redirect()->back()->with('error', 'Maximum allowed participants are: ' . $max_appointment_participants);
        // }

        $appointment_start_date = date("Y-m-d", strtotime($object->start_date));
        $today = date("Y-m-d");

        if ($object->id != 1) {
            //check if appointment start date is in the past
            if ($appointment_start_date < $today) {
                return redirect()->back()->with('error', 'Appointment Start Date is in the past');
            }

            if (!$object->canBeEdited()) {
                return redirect()->back()->with('error', 'Appointment can not be edited anymore');
            }
        }


        foreach ($request->customer_ids as $customer_id) {
            AppointmentCustomer::create([
                'appointment_id' => $object->id,
                'customer_id' => $customer_id,
            ]);
        }

        return redirect()->back()->with('success', 'Customers registered successfully');
    }

    public function registerCustomersView(Request $request, Appointment $object)
    {
        //get appointment customer ids
        $customer_ids = AppointmentCustomer::where('appointment_id', $object->id)->pluck('customer_id')->toArray();

        $customers = Customer::with(['office', 'office.organization'])->whereNotIn('id', $customer_ids);

        if (!empty($request->office_id)) {
            $office_id = $request->office_id;
            $customers->where('office_id', $office_id);
        };

        if (!empty($request->group)) {
            $customers->where('group_number', $request->group);
        };

        if (!empty($request->organization_id)) {
            $organization_id = $request->organization_id;
            $customers->whereHas('office', function ($q) use ($organization_id) {
                $q->where('organization_id', $organization_id);
            });
        }

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;

            $customers->where(function ($q) use ($keyword) {
                $q->where('id', 'like', '%' . $keyword . '%')
                    ->orWhere('name', 'like', '%' . $keyword  . '%');
            });
        };

        $customers = $customers->orderBy('group_number', 'desc')->paginate(50);
        $organizations = Organization::orderBy('name', 'asc')->get();

        $groups = Customer::all()->unique('group_number')->pluck('group_number');


        return view('admin.appointments.register_customers', compact('object', 'customers', 'organizations', 'groups'));
    }

    public function registeredCustomers(Request $request, Appointment $object)
    {

        // $customers = $object->customers()->with('customer', 'customer.office', 'customer.office.organization');

        $customers = AppointmentCustomer::where('appointment_id', $object->id)->with('customer', 'customer.office', 'customer.office.organization');

        if (!empty($request->office_id)) {
            $office_id = $request->office_id;

            $customers->whereHas('customer', function ($q) use ($office_id) {
                $q->where('office_id', $office_id);
            });
            // $customers->where('office_id', $request->office_id);
        };

        if (!empty($request->passed)) {
            if ($request->passed == 1) {

                $customers->whereRaw('final_point >= point_to_pass');
            }

            if ($request->passed == 2) {
                $customers->whereRaw('final_point < point_to_pass');
            }
        };

        if (!empty($request->group)) {
            $group = $request->group;

            $customers->whereHas('customer', function ($q) use ($group) {
                $q->where('group_number', $group);
            });
        };

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $customers->whereHas('customer', function ($q) use ($keyword) {
                $q->where('id', 'like', '%' . $keyword . '%')
                    ->orWhere('name', 'like', '%' . $keyword  . '%');
            });
        };

        $customers = $customers->orderBy('id', 'desc')->paginate(10);


        $organizations = Organization::orderBy('name', 'asc')->get();

        $groups = Customer::all()->unique('group_number')->pluck('group_number');

        return view('admin.appointments.registered_customers', compact('object', 'customers', 'organizations', 'groups'));
    }

    public function deleteRegisteredCustomer(AppointmentCustomer $object)
    {
        //check if appointment can be edited
        $appointment = Appointment::findOrFail($object->appointment_id);

        $appointment_start_date = date("Y-m-d", strtotime($appointment->start_date));
        $today = date("Y-m-d");

        //check if appointment start date is in the past
        if ($appointment->id != 1) {
            if ($appointment_start_date < $today) {
                return redirect()->back()->with('error', 'Appointment Start Date is in the past');
            }
        }


        if (!$appointment->canBeEdited()) {
            return redirect()->back()->with("error", "Appointment can't be updated Anymore");
        }

        $object->delete();

        return redirect()->back()->with('success', "Record Deleted successfully");
    }

    public function testResult(AppointmentCustomer $object)
    {
        $appointment = Appointment::Find($object->appointment_id);
        return view('admin.appointments.result', compact('object', 'appointment'));
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        $pdf = \PDF::loadView('admin/appointments/pdf', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }

    public function resend(Appointment $object)
    {

        if (!$object->reported) {
            return redirect()->back()->with('error', 'something went wrong');
        }
        try {

            DB::beginTransaction();
            //get appointment customers

            $appointmentCustomers = $object->customers;

            foreach ($appointmentCustomers as $customer) {
                $customer->reported = 0;
                $customer->save();
            }

            $object->reported = 0;
            $object->save();
            DB::commit();
        } catch (Throwable $e) {

            report($e);
            return redirect()->back()->with('error', 'something went wrong');
        }

        return redirect()->back()->with('success', 'record updated successfully');
    }
}
