<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Section::orderBy('id', 'desc')->paginate(10);

        return view('admin.sections.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $object)
    {

        return view('admin.sections.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, Section $object)
    {

        $object->title = $request->title;
        $object->text = $request->text;
        $object->url = $request->url;

        if ($request->status == 1) {
            $object->status = 1;
        } else {
            $object->status = 2;
        }

        $stats = [];

        if ($object->id == 1) {

            $stats = $request->stat_list;
        } else {
            $stats[]  = [
                'stat_icon' => $request->stat_icon[0],
                'stat_name' => $request->stat_name[0],
                'stat_number' => $request->stat_number[0],
            ];

            $stats[]  = [
                'stat_icon' => $request->stat_icon[1],
                'stat_name' => $request->stat_name[1],
                'stat_number' => $request->stat_number[1],
            ];

            $stats[]  = [
                'stat_icon' => $request->stat_icon[2],
                'stat_name' => $request->stat_name[2],
                'stat_number' => $request->stat_number[2],
            ];
        }




        $stat_string = json_encode($stats);
        $object->stats = $stat_string;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1920, $object->image);

            $object->image = $image;
        }

        $object->save();

        return redirect()->back()->with('success', 'Record Updated SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
