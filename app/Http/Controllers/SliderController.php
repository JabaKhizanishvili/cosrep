<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Slider::orderBy('position', 'asc')->get();

        return view('admin.sliders.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $object = new Slider();
        $object->name = $request->name;
        $object->url = $request->url;

        if ($request->status == 1) {
            $object->status = 1;
        } else {
            $object->status = 2;
        }


        if ($request->hasFile('image')) {

            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1920);

            $object->image = $image;
        }

        $object->save();

        return redirect()->route('admin.sliders.index')->with('success', 'Record Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $object)
    {
        return view('admin.sliders.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $object)
    {
        $object->name = $request->name;
        $object->url = $request->url;

        if ($request->status == 1) {
            $object->status = 1;
        } else {
            $object->status = 2;
        }

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1920, $object->image);

            $object->image = $image;
        }

        $object->save();

        return redirect(route('admin.sliders.index'))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $object)
    {
        if ($object->image != 'noimage.jpg') {
            $file_path = $object->getImagePath();
            if (File::exists(storage_path($file_path . $object->image))) {
                File::delete(storage_path($file_path . $object->image));
            }
        }

        $object->delete();

        return redirect()->back()->with('success', 'Record Deleted Successfully');
    }

    public function position()
    {
        $position = request('position');
        $i = 1;
        foreach ($position as $k => $v) {
            Slider::where('id', $v)->update(['position' => $i]);
            ++$i;
        }
    }
}
