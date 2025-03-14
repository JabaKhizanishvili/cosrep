<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Organization::withCount('offices');

        if ($request->sort == 'offices') {
            $objects->orderBy('offices_count', 'desc');
        }
        if ($request->sort == 'offices-') {
            $objects->orderBy('offices_count', 'asc');
        }

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);

        return view('admin.organizations.index', compact('objects'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
        $object = new Organization();
        $object->name = $request->name;
        $object->email = $request->email;
        $object->text = $request->text;

        $object->save();

        return redirect(route('admin.organizations.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organiation
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $object)
    {
        return view('admin.organizations.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationRequest $request, Organization $object)
    {
        $object->name = $request->name;
        $object->email = $request->email;
        $object->text = $request->text;

        $object->save();
        return redirect(route('admin.organizations.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $object)
    {
        //check if organization has offices
        if (count($object->offices) > 0) {
            $ids = $object->offices->pluck('id')->toArray();
            $ids = implode(', ', $ids);

            return redirect()->back()->with('error', 'You can not delete This record because it belongs To other record.  Office Ids:' . $ids);
        }
        $object->delete();

        return redirect()->back()->with('success', 'Record Deleted successfully');
    }
}
