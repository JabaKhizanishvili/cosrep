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
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $object)
    {

        return view('admin.sections.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, Section $object)
    {

        $object->setTranslations('title', $request->input('title'));
        $object->setTranslations('text', $request->input('text'));
        $object->url = $request->url;

        if ($request->status == 1) {
            $object->status = 1;
        } else {
            $object->status = 2;
        }

        $stats = [];

        if ($object->id == 1) {
//            $stats = $request->stat_list;
//            $stat_string = json_encode($stats);
            $object->stats = $request->input('stat_list');
        } else {
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
        }


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
     * @param \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
