<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequst;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Page::orderBy('position', 'asc')->get();

        return view('admin.pages.index', compact('objects'));
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
     * @param  \App\Models\Page  $object
     * @return \Illuminate\Http\Response
     */
    public function show(Page $object)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $object
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $object)
    {
        return view('admin.pages.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $object
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $object)
    {
        $object = Page::findOrFail($object->id);

        // $request->validated();
        $object->name = $request->name;
        $object->keyword = $request->keyword;
        $object->description = $request->description;

        //prevent to disable home page
        if ($object->slug != '/') {
            if ($request->status == 1) {
                $object->status = 1;
            } else {
                $object->status = 2;
            }
        }

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1920, $object->image);

            $object->image = $image;
        }


        $object->save();
        Page::clearCache();

        return redirect(route('admin.pages.index'))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $object
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $object)
    {
        //
    }

    public function position()
    {
        $position = request('position');
        $i = 1;
        foreach ($position as $k => $v) {
            Page::where('id', $v)->update(['position' => $i]);
            ++$i;
        }
        Page::clearCache();
    }
}
