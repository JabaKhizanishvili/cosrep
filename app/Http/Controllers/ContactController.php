<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
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
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $object = Contact::firstOrFail();
        return view('admin.contacts.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $object)
    {

        $object->phone = $request->phone;
        $object->email = $request->email;
        $object->address = $request->address;
        $object->facebook = $request->facebook;
        $object->youtube = $request->youtube;
        $object->linkedin = $request->linkedin;
        $object->map = $request->map;

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 800, $object->image);

            $object->image = $image;
        }
        $object->save();
        Contact::clearCache();

        return redirect()->back()->with('success', 'Record Updated SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
