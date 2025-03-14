<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Category::orderBy('position', 'asc')->withCount('trainings')->get();

        return view('admin.categories.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $object = new Category();
        $object->name = $request->name;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1200, null, 400);

            $object->image = $image;
        }

        $object->save();

        return redirect(route('admin.categories.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $object)
    {
        return view('admin.categories.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $object)
    {
        $object->name = $request->name;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1200, $object->image, 400);

            $object->image = $image;
        }

        $object->save();

        return redirect(route('admin.categories.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $object)
    {
        //check if route has customers
        if (count($object->trainings) > 0) {
            $ids = $object->trainings->pluck('id')->toArray();
            $ids = implode(', ', $ids);

            return redirect()->back()->with('error', 'You can not delete This record because it belongs To other record.  Training Ids:' . $ids);
        }

        if ($object->image != 'noimage.jpg') {
            $file_path = $object->getImagePath();
            $file_path_thumb = $object->getImagePath() . 'thumb/';


            if (File::exists(storage_path($file_path . $object->image))) {
                File::delete(storage_path($file_path . $object->image));
            }
            if (File::exists(storage_path($file_path_thumb . $object->image))) {
                File::delete(storage_path($file_path_thumb . $object->image));
            }
        }
        $object->delete();

        return redirect()->back()->with('success', 'Record Deleted successfully');
    }

    public function position()
    {
        $position = request('position');
        $i = 1;
        foreach ($position as $k => $v) {
            Category::where('id', $v)->update(['position' => $i]);
            ++$i;
        }
    }
}
