<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PartnerRequest;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Partner::orderBy('id', 'DESC')->paginate(10);

        return view('admin.partners.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        $object = new Partner();

//        $object->name = $request->name;
        $object->setTranslations('name', $request->get('name'));
        $object->url = $request->url;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 600);

            $object->image = $image;
        }


        $object->save();
        Partner::clearCache();

        return redirect(route('admin.partners.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $object)
    {
        return view('admin.partners.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, Partner $object)
    {
        $object->name = $request->name;
        $object->setTranslations('name', $request->input('name'));
        $object->url = $request->url;


        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 600, $object->image);

            $object->image = $image;
        }

        $object->save();

        Partner::clearCache();
        return redirect(route('admin.partners.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Partner $partner
     * @return \Illuminate\Http\Response
     */

    public function destroy(Partner $object)
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
