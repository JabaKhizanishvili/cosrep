<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use League\Glide\Server;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Service::where('id', '>', '0');

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);

        return view('admin.services.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $object = new Service();


        $object->setTranslations('name', $request->input('name'));
        $object->setTranslations('text', $request->input('text'));

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 800);

            $object->image = $image;
        }

        $object->slug = $request->input('slug');

        $object->save();

        return redirect(route('admin.services.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $object)
    {
        return view('admin.services.edit', compact('object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $object)
    {
        $object->setTranslations('name', $request->input('name'));
        $object->setTranslations('text', $request->input('text'));
        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 800);

            $object->image = $image;
        }

        $object->slug = $request->input('slug');

        $object->save();

        return redirect(route('admin.services.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    public function uploadImage(Service $service, Request $request)
    {
        // მითითება სრულ გზაზე, სადაც სურათები უნდა აიტვირთოს
        $storagePath = storage_path('app/public/images/services');

        // თუ ფოლდერი არ არსებობს, შექმენი
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0775, true);
        }

        // თუ ფაილი არსებობს, ატვირთე
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            // ხელმისაწვდომი ფაილის სახელის მიღება
            $fileName = $file->getClientOriginalName();

            // ფაილის ჩაწერა პირდაპირ 'storage/app/public/images/services' ფოლდერში
            $file->move($storagePath, $fileName);

            // URL მისამართი
            $url = asset('storage/images/services/' . $fileName);

            // დაბრუნება JSON პასუხი CKEditor-ისთვის
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false], 400);
    }

    public function browseMedia()
    {
        $images = Storage::disk('public')->files('images/services');

        $html = '<html><head>
                <title>Image Browser</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                <style>
                    body { padding: 20px; }
                    .image-container { display: flex; flex-wrap: wrap; gap: 10px; }
                    .image-box { width: 120px; height: 120px; overflow: hidden; cursor: pointer; border: 2px solid transparent; }
                    .image-box img { width: 100%; height: 100%; object-fit: cover; transition: 0.3s; }
                    .image-box:hover { border-color: #007bff; }
                </style>
            </head><body>';

        $html .= '<div class="container"><h3>Select an Image</h3><div class="image-container">';

        foreach ($images as $image) {
            $imageUrl = asset('storage/' . $image);
            $html .= "<div class='image-box' onclick='selectImage(\"{$imageUrl}\")'>
                    <img src='{$imageUrl}'>
                  </div>";
        }

        $html .= "</div></div>";

        $html .= "<script>
                function selectImage(url) {
                    window.opener.CKEDITOR.tools.callFunction({$_GET['CKEditorFuncNum']}, url);
                    window.close();
                }
              </script>";

        $html .= '</body></html>';

        return response($html);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $object)
    {
        $object->delete();

        return redirect()->back()->with('success', 'Record Deleted Successfully');
    }
}
