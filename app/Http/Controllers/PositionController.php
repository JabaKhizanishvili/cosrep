<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Position::withCount('customers');

        if ($request->sort == 'customers') {
            $objects->orderBy('customers_count', 'desc');
        }
        if ($request->sort == 'customers-') {
            $objects->orderBy('customers_count', 'asc');
        }

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);

        return view('admin.positions.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $object = new Position();
        $object->name = $request->name;

        $object->save();

        return redirect(route('admin.positions.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $object)
    {
        return view('admin.positions.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, Position $object)
    {
        $object->name = $request->name;

        $object->save();
        return redirect(route('admin.positions.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $object)
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
