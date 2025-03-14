<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Requests\OfficeRequest;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Office::with('organization')->withCount('customers');

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
            $objects->where('organization_id', $request->organization_id);
        };

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);
        $organizations = Organization::orderBy("name", 'asc')->get();

        return view('admin.offices.index', compact('objects', 'organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::orderBy('name', 'asc')->get();

        return view('admin.offices.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {

        $object = new Office();
        $object->name = $request->name;
        $object->address = $request->address;
        $object->organization_id = $request->organization_id;
        $object->save();

        return redirect(route('admin.offices.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $object)
    {
        $organizations = Organization::orderBy('name', 'asc')->get();

        return view('admin.offices.edit', compact('organizations', 'object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeRequest $request, Office $object)
    {
        $object->name = $request->name;
        $object->address = $request->address;
        $object->organization_id = $request->organization_id;
        $object->save();

        return redirect(route('admin.offices.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $object)
    {
        //check if organization has offices
        if (count($object->customers) > 0) {
            $ids = $object->customers->pluck('id')->toArray();
            $ids = implode(', ', $ids);

            return redirect()->back()->with('error', 'You can not delete This record because it belongs To other record.  Customer Ids:' . $ids);
        }
        $object->delete();

        return redirect()->back()->with('success', 'Record Deleted successfully');
    }
}
