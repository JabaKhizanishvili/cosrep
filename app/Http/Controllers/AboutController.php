<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $object = About::firstOrFail();

        // return json_decode($object->stats);
        return view('admin.about.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request, About $object)
    {

        $object->title = $request->title;
        $object->text = $request->text;

        $stats = [];

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


        $stat_string = json_encode($stats);

        $object->stats = $stat_string;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 800, $object->image);

            $object->image = $image;
        }

        $object->save();

        return redirect()->back()->with('success', 'Record Updated SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
