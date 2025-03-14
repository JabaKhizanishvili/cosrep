<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Blog::where('id', '>', '0');

        if ($request->sort == 'created_at') {
            $objects->orderBy('created_at', 'desc');
        }
        if ($request->sort == 'created_at-') {
            $objects->orderBy('created_at', 'asc');
        }



        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);

        return view('admin.blogs.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $object = new Blog();

        $object->name = $request->name;
        $object->text = $request->text;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 800);

            $object->image = $image;
        }

        $object->save();

        return redirect(route('admin.blogs.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $object)
    {
        return view('admin.blogs.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $object)
    {
        $object->name = $request->name;
        $object->text = $request->text;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 800, $object->image);

            $object->image = $image;
        }

        $object->save();

        return redirect(route('admin.blogs.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $object)
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
}
