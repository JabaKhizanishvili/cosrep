<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\TrainerRequest;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Trainer::with('trainings')->withCount("trainings");

        if ($request->sort == 'trainings') {
            $objects->orderBy('trainings_count', 'desc');
        }
        if ($request->sort == 'trainings-') {
            $objects->orderBy('trainings_count', 'asc');
        }

        if ($request->sort == 'created_at') {
            $objects->orderBy('created_at', 'desc');
        }
        if ($request->sort == 'created_at-') {
            $objects->orderBy('created_at', 'asc');
        }

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword  . '%')
                ->orWhere('email', 'like', '%' . $request->keyword  . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);

        return view('admin.trainers.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trainers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainerRequest $request)
    {
        $object = new Trainer();

        $object->name = $request->name;
        $object->email = $request->email;
        $object->facebook = $request->facebook;
        $object->twitter = $request->twitter;
        $object->linkedin = $request->linkedin;
        $object->instagram = $request->instagram;

        if ($request->hasFile('image')) {
            $file_path = '/app/public/trainers/';
            $image = FileUpload::image($file_path, request('image'), 600);

            $object->image = $image;
        }

        if ($request->hasFile('signature')) {
            $signature_path = $object->getSignaturePath();
            $signature = FileUpload::image($signature_path, request('signature'), 600);

            $object->signature = $signature;
        }

        $object->save();

        return redirect(route('admin.trainers.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $object)
    {
        return view('admin.trainers.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function update(TrainerRequest $request, Trainer $object)
    {
        $object->name = $request->name;
        $object->email = $request->email;

        $object->facebook = $request->facebook;
        $object->twitter = $request->twitter;
        $object->linkedin = $request->linkedin;
        $object->instagram = $request->instagram;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1920, $object->image);

            $object->image = $image;
        }

        if ($request->hasFile('signature')) {
            $signature_path = $object->getSignaturePath();
            $signature = FileUpload::image($signature_path, request('signature'), 1920, $object->signature);

            $object->signature = $signature;
        }

        $object->save();

        return redirect(route('admin.trainers.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $object)
    {
        if (!empty($object->trainings)) {
            if (count($object->trainings) > 0) {
                return redirect()->back()->with('error', 'Trainer Has Trainings and cant be deleted');
            }
        }
        if ($object->image != 'noimage.jpg') {
            $file_path = $object->getImagePath();
            $signature_path = $object->getSignaturePath();


            if (File::exists(storage_path($file_path . $object->image))) {
                File::delete(storage_path($file_path . $object->image));
            }
        }

        if (File::exists(storage_path($signature_path . $object->signature))) {
            File::delete(storage_path($signature_path . $object->signature));
        }

        $object->delete();

        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
