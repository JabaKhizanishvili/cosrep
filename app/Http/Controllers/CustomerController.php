<?php

namespace App\Http\Controllers;

use App\Models\AppointmentCustomer;
use http\Env\Response;
use Throwable;
use App\Models\Office;
use App\Models\Customer;
use App\Models\Position;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Imports\CustomerImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ImportCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Customer::with('office', 'office.organization');

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



        if (!empty($request->organization_id)) {
            $organization_id = $request->organization_id;
            $objects->whereHas('office', function ($q) use ($organization_id) {
                return $q->where('organization_id', $organization_id);
            });
        };

        if (!empty($request->office_id)) {
            $objects->where('office_id', $request->office_id);
        };

        if (!empty($request->group)) {
            $objects->where('group_number', $request->group);
        };

        if (!empty($request->keyword)) {
            $objects->where('username', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%')
                ->orWhere('email', 'like', '%' . $request->keyword  . '%')
                ->orWhere('username', 'like', '%' . $request->keyword  . '%');
        };

        $groups = Customer::all()->unique('group_number')->pluck('group_number');

        $objects = $objects->orderBy('group_number', 'desc')->paginate(30);

        $organizations = Organization::orderBy('name', 'asc')->get();



        return view('admin.customers.index', compact('objects', 'organizations', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::orderBy('name', 'desc')->get();
        $positions = Position::orderBy('name', 'asc')->get();

        return view('admin.customers.create', compact('organizations', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $object = new Customer();

        $object->office_id = $request->office_id;
        $object->position_id = $request->position_id;
        $object->name = $request->name;
        $object->email = $request->email;
        $object->username = $request->username;
        $object->password = $request->password ? Hash::make($request->password) : null;

        $object->save();

        return redirect(route('admin.customers.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $object)
    {

        $organizations = Organization::orderBy('name', 'desc')->get();
        $positions = Position::orderBy('name', 'asc')->get();

        $offices = Office::where('organization_id', $object->office->organization_id)->orderBy('name', 'desc')->get();


        return view('admin.customers.edit', compact('organizations', 'object', 'offices', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $object)
    {
        $object->office_id = $request->office_id;
        $object->position_id = $request->position_id;
        $object->name = $request->name;
        $object->email = $request->email;
        $object->username = $request->username;

        if ($request->password) {
            $object->password = Hash::make($request->password);
        }

        $object->save();

        return redirect(route('admin.customers.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $object)
    {
//        $object->delete();
//        return  redirect(back()->with('success', 'Record Deleted successfully'));
        if (count($object->appointments) > 0) {
            $ids = $object->appointments->pluck('id')->toArray();
            $ids = implode(', ', $ids);

            return redirect()->back()->with('error', 'You can not delete This record because it belongs To other appointments.  appoints Ids:' . $ids);
        }
        $object->delete();

        return redirect()->back()->with('success', 'Record Deleted successfully');


    }

//    public function massDelete(Request $request,Customer $object)
//    {
//        dd($request->input());
//        $ids = $request->input('ids');
//        if ($ids && count($ids)) {
//
//            Customer::whereIn('id', $ids)->delete();
//            return redirect()->back()->with('success', 'ჩანაწერები წაშლილია.');
//        }
//
//        return redirect()->back()->with('error', 'არაფერი არ არის მონიშნული.');
//    }

    public function massDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids || !is_array($ids) || count($ids) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'არაფერი არ არის მონიშნული.'
            ], 400);
        }

        try {
            Customer::whereIn('id', $ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'ჩანაწერები წარმატებით წაიშალა.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'შეცდომა წაშლისას: ' . $e->getMessage()
            ], 500);
        }
    }


    public function getOffices(Request $request)
    {
        $organization_id =  $request->organization_id;
        $result = Office::where('organization_id', $organization_id)->orderBy('name', 'desc')->get();

        return response()->json([
            'data' => $result,
        ]);
    }

    public function importView()
    {
        $organizations = Organization::orderBy('name', 'asc')->get();
        return view('admin.customers.import', compact('organizations'));
    }

    public function import(ImportCustomerRequest $request)
    {
        $office_id = $request->office_id;
        //get group id
        $groupId = (int) Customer::max('group_number') + 1;
        $color = randColor($groupId);
        $color = $color[0] . ',' . $color[1] . ',' . $color[2];

        try {
            Excel::import(new CustomerImport($office_id, $groupId, $color), $request->file('file'));
        } catch (Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect(route('admin.customers.index'))->with('status', 'The file has been excel/csv imported to database in laravel 8');
    }

    public function updateGroup(Customer $object, Request $request)
    {
        //check if suggested group exists
        if (!is_numeric($request->group_id)) {
            return redirect()->back()->withInput()->with('error', 'group is not number');
        }

        //check if group exists
        $groupRecord = Customer::where('group_number', $request->group_id)->first();
        if (empty($groupRecord)) {
            return redirect()->back()->withInput()->with('error', 'group does not exist');
        }

        $object->group_number = $groupRecord->group_number;
        $object->color = $groupRecord->color;
        $object->save();

        return redirect()->back()->withInput()->with('success', 'group updated successfully');
    }
}
