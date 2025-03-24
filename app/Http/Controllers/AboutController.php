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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\About $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\About $about
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\About $about
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request, About $object)
    {

//        $object->title = $request->title;
//        $object->text = $request->text;


        $stats = [
            'ge' => [],
            'en' => []
        ];

        foreach ($request->stat_icon as $key => $icon) {
            $stats['ge'][] = [
                'stat_icon' => $icon,
                'stat_name' => $request->stat_name_ge[$key] ?? '',
                'stat_number' => $request->stat_number[$key] ?? '',
            ];
            $stats['en'][] = [
                'stat_icon' => $icon,
                'stat_name' => $request->stat_name_en[$key] ?? '',
                'stat_number' => $request->stat_number[$key] ?? '',
            ];
        }


        $object->setTranslations('stats', $stats);

        // სტატისტიკების შენახვა, როგორც თარგმნილი მონაცემები
//        $object->setTranslations('stats', $stats);


//        $object->setTranslations('stats', $stats);
        $object->setTranslations('title', $request->input('title'));
        $object->setTranslations('text', $request->input('text'));

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
     * @param \App\Models\About $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
