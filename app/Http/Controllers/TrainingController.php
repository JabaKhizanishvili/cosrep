<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Models\Office;
use App\Models\Trainer;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Training;
use Illuminate\Http\File;
use App\Models\Appointment;
use App\Models\Organization;
use App\Models\TrainingTest;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Models\TrainingMedia;
use Aws\S3\MultipartUploader;
use Aws\Exception\AwsException;
use App\Models\AppointmentCustomer;
use App\Http\Requests\TrainingRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\UpdateMediaRequest;
use Illuminate\Support\Facades\Validator;
use Aws\Exception\MultipartUploadException;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objects = Training::with(['trainer', 'category']);

        if ($request->sort == 'customers') {
            $objects->orderBy('customers_count', 'desc');
        }
        if ($request->sort == 'customers-') {
            $objects->orderBy('customers_count', 'asc');
        }

        if ($request->sort == 'created_at') {
            $objects->orderBy('created_at', 'desc');
        }
        if ($request->sort == 'created_at-') {
            $objects->orderBy('created_at', 'asc');
        }

        if (!empty($request->trainer_id)) {
            $objects->where('trainer_id', $request->trainer_id);
        };

        if (!empty($request->category_id)) {
            $objects->where('category_id', $request->category_id);
        };

        if (!empty($request->keyword)) {
            $objects->where('id', 'like', '%' . $request->keyword . '%')
                ->orWhere('name', 'like', '%' . $request->keyword . '%');
        };

        $objects = $objects->orderBy('id', 'desc')->paginate(10);

        $categories = Category::orderBy('name', 'asc')->get();
        $trainers = Trainer::orderBy('id', 'desc')->get();

        return view('admin.trainings.index', compact('objects', 'categories', 'trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainers = Trainer::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('position', 'asc')->get();

        return view('admin.trainings.create', compact('trainers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainingRequest $request)
    {
        $object = new Training();

        $object->name = $request->name;
        $object->setTranslations('title', $request->input('title'));
        $object->setTranslations('text', $request->input('text'));
        $object->category_id = $request->category_id;
        $object->trainer_id = $request->trainer_id;
        $object->point_to_pass = $request->point_to_pass;


        if (is_array($request->names) && is_array($request->urls)) {
            $urls = $request->urls;
            $names = $request->names;
            if (count($urls) == count($names)) {

                $data = [];
                foreach ($request->names as $k => $n) {
                    $data[] = [
                        'name' => $n,
                        'url' => $urls[$k],
                    ];
                }
                $object->resources = json_encode($data);
            }
        }

        if ($request->status == 1) {
            $object->status = 1;
        } else {
            $object->status = 2;
        }

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1920, null, 400);

            $object->image = $image;
        }

        $object->save();

        return redirect(route('admin.trainings.index'))->with('success', 'Record added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Training $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Training $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $object)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $trainers = Trainer::orderBy('id', 'desc')->get();

        return view('admin.trainings.edit', compact('object', 'categories', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Training $training
     * @return \Illuminate\Http\Response
     */
    public function update(TrainingRequest $request, Training $object)
    {
        $object->name = $request->name;
        $object->setTranslations('title', $request->input('title'));
        $object->setTranslations('text', $request->input('text'));
        $object->category_id = $request->category_id;
        $object->trainer_id = $request->trainer_id;
        $object->point_to_pass = $request->point_to_pass;

        if ($request->status == 1) {
            $object->status = 1;
        } else {
            $object->status = 2;
        }

        if (is_array($request->names) && is_array($request->urls)) {
            $urls = $request->urls;
            $names = $request->names;
            if (count($urls) == count($names)) {

                $data = [];
                foreach ($request->names as $k => $n) {
                    $data[] = [
                        'name' => $n,
                        'url' => $urls[$k],
                    ];
                }
                $object->resources = json_encode($data);
            }
        } else {
            $object->resources = null;
        }

        if ($request->hasFile('image')) {
            $file_path = $object->getImagePath();
            $image = FileUpload::image($file_path, request('image'), 1920, $object->image, 400);

            $object->image = $image;
        }

        $object->save();

        return redirect(route('admin.trainings.index', ['page' => $request->page]))->with('success', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Training $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
    }

    public function testView(Training $object)
    {
        return view('admin.trainings.test', compact('object'));
    }

    public function addQuestion(Request $request, Training $object)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:255',
            "answers" => "required|min:1",
            "answers.*" => "required|min:1",
            "correct" => "required",
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->with("error", $errors);
        }
        $test = new TrainingTest();
        $test->training_id = $object->id;
        $test->setTranslations('question', $request->input('question'));
        $test->setTranslations('answers', $request->input('answers'));
        $test->correct = $request->correct;
//        $test->question = $request->question;
//        $test->answers = json_encode($request->answers);
        $test->save();

        return redirect()->back()->with("success", "Record Created Successfully");
    }

    public function deleteQuestion(TrainingTest $object)
    {
        $object->delete();
        return redirect()->back()->with("success", "Record deleted Successfully");
    }

    public function updateQuestion(Request $request, TrainingTest $object)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:255',
            "answers" => "required|min:1",
            "answers.*" => "required|min:1",
            "correct" => "required",
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withInput()->with("error", $errors);
        }
//        $object->question = $request->question;
//        $object->answers = json_encode($request->answers);
        $object->correct = $request->correct;
        $object->setTranslations('question', $request->input('question'));
        $object->setTranslations('answers', $request->input('answers'));
        $object->save();

        return redirect()->back()->with("success", "Record Created Successfully");
    }

    public function mediaView(Training $object)
    {
        return view('admin.trainings.media', compact("object"));
    }

    public function media(Request $request)
    {

        if (empty($request->input('file_ge'))) {
            return redirect()->back()->withInput()->with("error", "ატვირთეთ ფაილები");
        }

        if (empty($request->input('file_en'))) {
            return redirect()->back()->withInput()->with("error", "ატვირთეთ ფაილები");
        }


        $amazon_s3_url = config('meta.amazon_s3_url');


        $path_ge = str_replace($amazon_s3_url, '', $request->input('file_ge'));
        $path_en = str_replace($amazon_s3_url, '', $request->input('file_en'));

        $media = new TrainingMedia();
        $media->training_id = $request->training_id;
        $media->type = $request->type;
        $media->setTranslations('name', $request->input('name'));

        $media->setTranslations('path', [
            'ge' => $path_ge,
            'en' => $path_en,
        ]);


        $media->save();

//        return response()->json('ok', 200);
        return redirect()->back()->with("success", "Record Created Successfully");
    }

    public function updateMedia(TrainingMedia $object, UpdateMediaRequest $request)
    {
//        $object->name = $request->name;
        $object->setTranslations('name', $request->input('name'));
        $object->save();
        return redirect()->back()->with('success', "record updated successfully");
    }

    public function deleteMedia(TrainingMedia $object)
    {
        $filesistem = Storage::disk('s3');

        if ($filesistem->exists($object->path)) {
            if (!$filesistem->delete($object->path)) {
                return redirect()->back()->withInput()->with("error", "media Could not be deleted");
            }

            $object->delete();
            return redirect()->back()->with("success", "Media deleted successfully");
        }
        $object->delete();
        //?????
        return redirect()->back()->withInput()->with("error", "File not Exists");
    }

    public function trainingCustomers(Request $request, Training $object)
    {
        //get customers which finished specific training

        $appointments = Appointment::where('training_id', $object->id)->with('customers')->pluck('id')->toArray();

        $organizations = Organization::orderBy('name', 'asc')->get();

        $appointmentCustomers = AppointmentCustomer::with(['customer', 'customer.office', 'customer.office.organization', 'customer.position', 'appointment'])->whereIn('appointment_id', $appointments)->whereNotNull('finished_at');

        if (!empty($request->office_id)) {
            $office_id = $request->office_id;
            $appointmentCustomers->whereHas('customer', function ($q) use ($office_id) {
                return $q->where('office_id', $office_id);
            });
        }


        if (!empty($request->passed)) {
            if ($request->passed == 1) {
                $appointmentCustomers->whereRaw('final_point >= point_to_pass');
            }

            if ($request->passed == 2) {
                $appointmentCustomers->whereRaw('final_point < point_to_pass');
            }
        };

        if (!empty($request->appointment_id)) {

            $appointmentCustomers->where('appointment_id', $request->appointment_id);
        };

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $appointmentCustomers->whereHas('customer', function ($q) use ($keyword) {
                return $q->where('id', 'like', '%' . $keyword . '%')
                    ->orWhere('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }


        if (!empty($request->generatePdf)) {

            //check if specific appointment is selected
            if (empty($request->appointment_id)) {
                return redirect()->back()->with('error', 'you have to select specific appointment to generate start and end date of the training');
            }

            if (empty($request->office_id)) {
                return redirect()->back()->with('error', 'you have to select specific office to generate Facility of the training');
            }

            $appointment = Appointment::findOrFail($request->appointment_id);
            $office = Office::findOrFail($request->office_id);

            $customer_ids = $appointmentCustomers->pluck('customer_id')->toArray();
            $customers = Customer::with('position')->whereIn('id', $customer_ids)->get();

            $pdfName = date("d-M-Y_H-i", strtotime($appointment->start_date)) . ' - ' . $appointment->training->name . ' - ' . $office->name;

            $data = [
                'training_name' => $object->name,
                'media' => $object->media,
                'trainer_name' => $object->trainer->name,
                'start_date' => $appointment->getStartDate(),
                'end_date' => $appointment->getEndDate(),
                'office' => $office,
                'organization' => $office->organization,
                'customers' => $customers,
                'trainer_signature' => signatureImage($object->trainer->signature),
                'documentName' => $pdfName,

            ];


            return view('admin/appointments/pdf', compact('data'));

            // $pdf = \PDF::loadView('admin/appointments/pdf', $data);
            // return $pdf->download($pdfName);
        }

        $appointmentCustomers = $appointmentCustomers->orderBy('appointment_id', 'desc')->paginate(10);
        $appointments = Appointment::done()->where('training_id', $object->id)->get();

        return view('admin.trainings.trainingCustomers', compact('appointmentCustomers', 'object', 'organizations', 'appointments'));
    }

    public function position()
    {
        $position = request('position');
        $i = 1;
        foreach ($position as $k => $v) {
            TrainingMedia::where('id', $v)->update(['position' => $i]);
            ++$i;
        }
    }
}
