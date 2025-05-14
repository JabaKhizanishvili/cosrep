<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TrainingOrder;
use Throwable;
use App\Models\Blog;
use App\Models\Page;
use App\Models\About;
use App\Models\Policy;
use App\Models\Slider;
use App\Models\Partner;
use App\Models\Section;
use App\Models\Service;
use App\Models\Trainer;
use App\Models\Category;
use App\Models\Training;
use App\Mail\ContactMail;
use App\Services\AuthType;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\AppointmentCustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EndTestRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\ContactEmailRequest;
use App\Http\Requests\sendTrainerMessageRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\ExternalUser;
use Illuminate\Auth\Events\Registered;
use App\Models\Certificate;

class FrontEndController extends Controller
{
    public function index()
    {
//       dd(Auth::guard('external')->user());
//        $page = Page::where('slug', '/')->firstOrFail();
        $page = Page::getCachedPageBySlug('/');
        $sliders = Slider::active()->orderBy('position', 'asc')->get();
//        $partners = Partner::orderBy('id', 'desc')->get();
        $partners = Partner::getCachedPartners();
        $section_one = Section::where('id', 1)->active()->first();
        $section_two = Section::where('id', 2)->active()->first();


        return view('front.index', compact('sliders', 'partners', 'section_one', 'section_two', 'page'));
    }

    public function contact()
    {
//        $page = Page::where('slug', '/contact')->firstOrFail();
        $page = Page::getCachedPageBySlug('/contact');

        return view('front.contact', compact('page'));
    }

    public function sendEmail(ContactEmailRequest $request)
    {
        try {
            Mail::to(config('mail.from.address'))->send(new ContactMail($request->validated()));
        } catch (Throwable $e) {
            report($e);

            return redirect()->back()->with('error', __('page.email_send_error'));
        }

        return redirect()->back()->with('success', __('page.email_sent_success'));
    }

    public function sendTrainerMessage($locale, sendTrainerMessageRequest $request, Training $object)
    {
        $customer = Auth::guard('customer')->user();
        $request->request->add(['training_name' => $object->name, 'name' => $customer->name, 'personal_number' => $customer->username, 'trainer_email' => true]);


        $url = back()->getTargetUrl();
        $url = $url . '#contact';

        try {
            Mail::to(config('mail.from.address'))->send(new ContactMail($request->all()));
        } catch (Throwable $e) {
            report($e);

            return redirect($url)->with('error', __('page.email_send_error'));
        }


        return redirect($url)->with('success', __('page.email_sent_success'), '#contact');
    }

    public function about()
    {
//        $page = Page::where('slug', '/about-us')->firstOrFail();
        $page = Page::getCachedPageBySlug('/about-us');

        $about = About::firstOrFail();
        $trainers = Trainer::OrderBy('id', 'desc')->get();
        $section_one = Section::where('id', 1)->active()->first();

        return view('front.about', compact('page', 'about', 'trainers', 'section_one'));
    }

    public function trainings()
    {
//        $page = Page::where('slug', '/trainings')->firstOrFail();
        $page = Page::getCachedPageBySlug('/trainings');
        $categories = Category::withCount('frontTrainings')->orderBy('position', 'asc')->paginate(6);


        return view('front.categories', compact('categories', 'page'));
    }

    public function categoryTrainings($locale, $name)
    {
        $name = urldecode($name);
        $category = Category::where('name', $name)->firstOrFail();
        $page = Page::where('slug', '/trainings')->firstOrFail();
        $trainings = Training::active()->where('category_id', $category->id)->paginate(9);

        return view('front.trainings', compact('trainings', 'page', 'category'));
    }

    public function blogs()
    {
//        $page = Page::where('slug', '/blogs')->firstOrFail();
        $page = Page::getCachedPageBySlug('/blogs');
        $blogs = Blog::orderBy('id', 'desc')->paginate(6);


        return view('front.blogs', compact('blogs', 'page'));
    }

    public function singleBlog($locale, $name)
    {

        $page = Page::where('slug', '/blogs')->firstOrFail();
        $page = Page::getCachedPageBySlug('/blogs');
        $name = urldecode($name);
        $blog = Blog::where('name->ge', $name)
            ->orWhere('name->en', $name)
            ->firstOrFail();
//        $blogs = Blog::where('id', '!=', $blog->id)->limit(5)->get();
        $blogs = Blog::where('id', '!=', $blog->id)->orderBy('created_at', 'desc')->limit(5)->get();

        return view('front.singleBlog', compact('blog', 'blogs', 'page'));
    }

    public function singleTraining($locale, $name)
    {
        $page = Page::where('slug', '/trainings')->firstOrFail();
        $name = urldecode($name);
        $training = Training::where('name', $name)->firstOrFail();

        return view('front.singleTraining', compact('training', 'page'));
    }

    public function loginView()
    {
        $page = Page::where('slug', '/login')->firstOrFail();

        return view('front.login', compact('page'));
    }

    public function Register(Request $request)
    {
        $page = Page::where('slug', '/login')->firstOrFail();
        return view('front.externalRegister', compact('page'));
    }

    public function Register_user(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:external_users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:external_users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = ExternalUser::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::guard('external')->login($user);
        return redirect()->intended('/');

    }

//    public function login(LoginRequest $request)
//    {
//
//        $credentials = $request->only('username', 'password');
//        if (Auth::guard(AuthType::TYPE_CUSTOMER)->attempt($credentials)) {
////            return redirect(RouteServiceProvider::CUSTOMER_HOME);
//            return redirect(route('front.dashboard'));
//        }
//
//        if (Auth::guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->attempt($credentials)) {
////            return redirect(RouteServiceProvider::CUSTOMER_HOME);
//            return redirect(route('front.dashboard'));
//        }
//
//        return redirect()->back()->with('error', 'Username ან Password არასწორია');
//    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated(); // ვიყენებთ validated() მონაცემებს Request-დან

        // ვცდილობთ ჯერ customer-ით შესვლას
        if (Auth::guard(AuthType::TYPE_CUSTOMER)->attempt($credentials)) {
        $request->session()->regenerate(); // უსაფრთხოებისთვის
            return redirect()->intended(route('front.dashboard'));
        }

        // ვცდილობთ external-ით შესვლას
        if (Auth::guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('front.dashboard'));
        }

        // თუ ვერ შევიდა ორივე გარდით
        return back()
            ->withInput($request->only('username')) // დავაბრუნოთ username
            ->withErrors([
                'username' => 'მოცემული მონაცემები არ შეესაბამება ჩვენს ჩანაწერებს',
            ]);
    }

//    change password
    public function changePasswordView(Request $request)
    {
        $page = Page::where('slug', '/login')->firstOrFail();
        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
        return view('front.changePasswordView', compact('customer', 'page'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);
        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
        if (!Hash::check($request->old_password, $customer->password)) {
            return back()->with('error', __('auth.incorrect_password'));
        }
        $customer->password = Hash::make($request->new_password);
        $customer->save();
        return back()->with('success', __('auth.password_updated'));

    }

//    public function dashboard(Request $request)
//    {
////        $page = Page::where('slug', '/dashboard')->firstOrFail();
//        $page = Page::getCachedPageBySlug('/dashboard');
//
//        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
//        $appointments = $customer->appointments();
//
//        if (!empty($request->done) && $request->done == 1) {
//            $appointments->done();
//        } elseif (!empty($request->future) && $request->future == 1) {
//            $appointments->future();
//        } elseif (!empty($request->open) && $request->open == 1) {
//            $appointments->open();
//        } elseif (!empty($request->all) && $request->all == 1) {
//            $appointments->all();
//        } else {
//            $appointments->open();
//        }
//        $appointments = $appointments->paginate(10);
//
//
//        return view('front.dashboard', compact('customer', 'page', 'appointments'));
//    }


    public function dashboard(Request $request)
    {
        $page = Page::getCachedPageBySlug('/dashboard');

        if (auth()->guard(AuthType::TYPE_CUSTOMER)->check()) {
            $user = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
            $appointments = $user->appointments();

            if (!empty($request->done) && $request->done == 1) {
                $appointments->done();
            } elseif (!empty($request->future) && $request->future == 1) {
                $appointments->future();
            } elseif (!empty($request->open) && $request->open == 1) {
                $appointments->open();
            } elseif (!empty($request->all) && $request->all == 1) {
                $appointments->all();
            } else {
                $appointments->open();
            }

            $appointments = $appointments->paginate(10);

            return view('front.dashboard', [
                'customer' => $user,
                'page' => $page,
                'appointments' => $appointments,
            ]);

        } elseif (auth()->guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->check()) {
            $user = auth()->guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->user();
//            $appointments = $user->orders();
            $query = TrainingOrder::with('customer', 'training')
                ->where('external_user_id', Auth::id());

            if ($request->type == 'online') {
                $query->where('type', 'online');
            } elseif ($request->type == 'offline') {
                $query->where('type', 'offline');
            }else{
                $query->where('type', 'offline');
            }

            $certificates = $user->certificates()->with('training')->get();
            $trainings = $query->paginate(10);

            return view('front.external_dashboard', [
                'user' => $user,
                'page' => $page,
                'trainings' => $trainings,
//                'appointments' => $appointments,
                'certificates' =>  $certificates,
            ]);
        }

        // თუ არც ერთი არაა ავტორიზებული
        return redirect()->route('login')->withErrors('Unauthorized');
    }



    public function startTrainingView($locale, Appointment $object)
    {
        $page = Page::where('slug', '/dashboard')->firstOrFail();

        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
        //check if customer can process current appointment
        $appointmentCustomer = AppointmentCustomer::where('appointment_id', $object->id)->where('customer_id', $customer->id)->first();

        if (empty($appointmentCustomer)) {
            $content = "<h2>თქვენ არ ხართ რეგისტრირებული არსებულ ტრენინგზე</h2>";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if customer finished test
        if (!empty($appointmentCustomer->finished_at) && $appointmentCustomer->customer_id != '1723') {
            $content = "<h2>თქვენ უკვე დაასრულეთ არსებული ტრენინგი</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>
            <p>შედეგის სანახავად გთხოვთ ესტუმროთ ლინკს: <a style='color:#0097e6' target='_blank' href='" . route('front.testDetails', $object) . "'><strong>" . route('front.testDetails', $object) . "</strong></a></p>
            ";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if training appointment is open
        if (!$object->isOpen()) {

            $content = "<h2>ტრენინგი არ არის აქტიური</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

        $appointment = $object;

        $page = Page::where('slug', '/dashboard')->firstOrFail();

        return view('front.startTraining', compact('customer', 'page', 'appointment'));
    }


    public function startExternalTrainingView($locale, TrainingOrder $object)
    {
        $page = Page::where('slug', '/dashboard')->firstOrFail();
        $customer = auth()->guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->user();
        //check if customer can process current appointment
        $appointmentCustomer = TrainingOrder::where('training_id', $object->training_id)
            ->where('external_user_id', $customer->id)
            ->where('type', 'online')
            ->first();

        if (empty($appointmentCustomer)) {
            $content = "<h2>თქვენ არ ხართ რეგისტრირებული არსებულ ტრენინგზე</h2>";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if customer finished test
        if (!empty($appointmentCustomer->finished_at) && $appointmentCustomer->customer_id != '1723') {
            $content = "<h2>თქვენ უკვე დაასრულეთ არსებული ტრენინგი</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>
            <p>შედეგის სანახავად გთხოვთ ესტუმროთ ლინკს: <a style='color:#0097e6' target='_blank' href='" . route('front.testDetails', $object) . "'><strong>" . route('front.testDetails', $object) . "</strong></a></p>
            ";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if training appointment is open
        if (!$object->isOpen()) {

            $content = "<h2>ტრენინგი არ არის აქტიური</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

        $appointment = $object;

        $page = Page::where('slug', '/dashboard')->firstOrFail();

        return view('front.ExternalstartTraining', compact('customer', 'page', 'appointment'));
    }

    public function startTestView($locale, Appointment $object)
    {
        $page = Page::where('slug', '/dashboard')->firstOrFail();

        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
        //check if customer can process current appointment
        $appointmentCustomer = AppointmentCustomer::where('appointment_id', $object->id)->where('customer_id', $customer->id)->first();

        if (empty($appointmentCustomer)) {
            $content = "<h2>თქვენ არ ხართ რეგისტრირებული არსებულ ტრენინგზე</h2>";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if customer finished test
        if (!empty($appointmentCustomer->finished_at)) {
            $content = "<h2>თქვენ უკვე დაასრულეთ არსებული ტრენინგი</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>
            <p>შედეგის სანახავად გთხოვთ ესტუმროთ ლინკს: <a style='color:#0097e6' target='_blank' href='" . route('front.testDetails', $object) . "'><strong>" . route('front.testDetails', $object) . "</strong></a></p>
            ";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if training appointment is open
        if (!$object->isOpen()) {

            $content = "<h2>ტრენინგი არ არის აქტიური</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

        $appointment = $object;

        return view('front.startTest', compact('customer', 'page', 'appointment'));
    }

    public function startExternalTestView($locale, TrainingOrder $object )
    {
        $page = Page::where('slug', '/dashboard')->firstOrFail();

        $customer = auth()->guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->user();
        //check if customer can process current appointment
        $appointmentCustomer = TrainingOrder::where('training_id', $object->training_id)
            ->where('external_user_id', $customer->id)
            ->where('type', 'online')
            ->first();


        if (empty($appointmentCustomer)) {
            $content = "<h2>თქვენ არ ხართ რეგისტრირებული არსებულ ტრენინგზე</h2>";

            return view('front.inactive', compact('page', 'content'));
        }
        //check if customer finished test
        if (!empty($appointmentCustomer->finished_at)) {
            $content = "<h2>თქვენ უკვე დაასრულეთ არსებული ტრენინგი</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>
            <p>შედეგის სანახავად გთხოვთ ესტუმროთ ლინკს: <a style='color:#0097e6' target='_blank' href='" . route('front.testDetails', $object) . "'><strong>" . route('front.testDetails', $object) . "</strong></a></p>
            ";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if training appointment is open
        if (!$object->isOpen()) {

            $content = "<h2>ტრენინგი არ არის აქტიური</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

        $appointment = $object;

        return view('front.startTest', compact('customer', 'page', 'appointment'));

    }



    public function endTest($locale, EndTestRequest $request, Appointment $object)
    {
        $page = Page::where('slug', '/dashboard')->firstOrFail();
        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
        //check if customer can process current appointment
        $appointmentCustomer = AppointmentCustomer::where('appointment_id', $object->id)->where('customer_id', $customer->id)->first();

        if (empty($appointmentCustomer)) {
            $content = "<h2>თქვენ არ ხართ რეგისტრირებული არსებულ ტრენინგზე</h2>";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if customer finished test
        if (!empty($appointmentCustomer->finished_at)) {
            $content = "<h2>თქვენ უკვე დაასრულეთ არსებული ტრენინგი</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>
            <p>შედეგის სანახავად გთხოვთ ესტუმროთ ლინკს: <a style='color:#0097e6' target='_blank' href='" . route('front.testDetails', $object) . "'><strong>" . route('front.testDetails', $object) . "</strong></a></p>
            ";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if training appointment is open
        if (!$object->isOpen()) {

            $content = "<h2>ტრენინგი არ არის აქტიური</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

        $final_point = 0;

        //testing appointment
        if ($object->id === 1) {
            return redirect()->back()->with('error', 'სატესტო ვერსიაში ტესტს ვერ დაასრულებთ');
        }
        //get training questions
        $questions = $object->training->tests;
        $customer_answered = [];
        foreach ($questions as $question) {
            if (!$request->has("answer_$question->id")) {
                return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ ახლიდან')->withInput();
            }

            $answered = abs((int)$request->get("answer_$question->id"));

            //check if answer exists in our table
            $answers = is_array($question->answers) ? $question->answers : json_decode($question->answers);
            $answers_count = count($answers);
            if ($answered > $answers_count - 1) {
                return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ ახლიდან')->withInput();
            }
            $correct_answer = $question->correct;
            if ($answered == $correct_answer) {
                $final_point++;
            }
            $customer_answered[] = $answered;
        }

        $appointmentCustomer->test = json_encode($questions);
        $appointmentCustomer->answers = json_encode($customer_answered);
        $appointmentCustomer->final_point = $final_point;
        $appointmentCustomer->point_to_pass = $object->training->point_to_pass;

        $appointmentCustomer->finished_at = now();
        $appointmentCustomer->save();


        return redirect()->route('front.testDetails', $object);


        // return $answers_count;
    }


    public function endTestForExternal($locale, EndTestRequest $request, TrainingOrder $object)
    {
        $page = Page::where('slug', '/dashboard')->firstOrFail();
        $customer = auth()->guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->user();
        //check if customer can process current appointment
        $appointmentCustomer = TrainingOrder::with('training','training.trainer')
            ->where('training_id', $object->training_id)
            ->where('external_user_id', $customer->id)
            ->where('type', 'online')
            ->first();
        $signature = $appointmentCustomer->training->trainer->signature;

        if (empty($appointmentCustomer)) {
            $content = "<h2>თქვენ არ ხართ რეგისტრირებული არსებულ ტრენინგზე</h2>";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if customer finished test
        if (!empty($appointmentCustomer->finished_at)) {
            $content = "<h2>თქვენ უკვე დაასრულეთ არსებული ტრენინგი</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>
            <p>შედეგის სანახავად გთხოვთ ესტუმროთ ლინკს: <a style='color:#0097e6' target='_blank' href='" . route('front.testDetails', $object) . "'><strong>" . route('front.testDetails', $object) . "</strong></a></p>
            ";

            return view('front.inactive', compact('page', 'content'));
        }

        //check if training appointment is open
        if (!$object->isOpen()) {

            $content = "<h2>ტრენინგი არ არის აქტიური</h2>
            <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
            <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
            <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

        $final_point = 0;

        //testing appointment
//        if ($object->id === 1) {
//            return redirect()->back()->with('error', 'სატესტო ვერსიაში ტესტს ვერ დაასრულებთ');
//        }
        //get training questions
        $questions = $object->training->tests;
        $customer_answered = [];
        foreach ($questions as $question) {
            if (!$request->has("answer_$question->id")) {
                return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ ახლიდან')->withInput();
            }

            $answered = abs((int)$request->get("answer_$question->id"));

            //check if answer exists in our table
            $answers = is_array($question->answers) ? $question->answers : json_decode($question->answers);
            $answers_count = count($answers);
            if ($answered > $answers_count - 1) {
                return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ ახლიდან')->withInput();
            }
            $correct_answer = $question->correct;
            if ($answered == $correct_answer) {
                $final_point++;
            }
            $customer_answered[] = $answered;
        }
        $appointmentCustomer->test = json_encode($questions);
        $appointmentCustomer->answers = json_encode($customer_answered);
        $appointmentCustomer->final_point = $final_point;
        $appointmentCustomer->point_to_pass = $object->training->point_to_pass;

        $appointmentCustomer->finished_at = now();
        $appointmentCustomer->save();


        if($appointmentCustomer->final_point >= $appointmentCustomer->point_to_pass){
            $certificate = GenerateCertificate($customer, $object->training,now(),$signature);
            return redirect()->route('front.dashboard' ,['type' => 'online'])->with('success', 'სერტიფიკატი გენერირებულია!');
        }

        return redirect()->route('front.testDetailsForExternal', $object);
        // return $answers_count;
    }

    public function download($locale,$id)
    {
        $certificate = Certificate::findOrFail($id);
        $filePath = storage_path('app/public/' . $certificate->file_path);

        if (!file_exists($filePath)) {
            abort(404);
        }

        $certificate->update(['downloaded_at' => now()]);

        return response()->download($filePath);
    }

    public function testDetails($locale, Appointment $object)
    {
        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
        //check if customer can process current appointment
        $appointmentCustomer = AppointmentCustomer::where('appointment_id', $object->id)->where('customer_id', $customer->id)->firstOrFail();
        $page = Page::where('slug', '/dashboard')->firstOrFail();
        //check if customer finished test
        if (empty($appointmentCustomer->finished_at)) {
            //check if customer finished test
            $content = "<h2>ტრენინგი არ არის დასრულებული</h2>
        <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
        <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
        <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

        $appointment = $object;


        return view('front.testDetails', compact('customer', 'page', 'appointment', 'appointmentCustomer'));
    }


    public function testDetailsForExternal($locale, TrainingOrder $object)
    {
        $customer = auth()->guard(AuthType::TYPE_EXTERNAL_CUSTOMER)->user();
        $appointmentCustomer = TrainingOrder::where('training_id', $object->training_id)
        ->where('external_user_id', $customer->id)
        ->where('type', 'online')
            ->firstOrFail();
        $page = Page::where('slug', '/dashboard')->firstOrFail();
        //check if customer finished test
        if (empty($appointmentCustomer->finished_at)) {
            //check if customer finished test
            $content = "<h2>ტრენინგი არ არის დასრულებული</h2>
        <p>ტრენინგი სახელი:  <strong>" . $object->training->name . "</strong>
        <p>ტრენინგი დაწყების დრო:  <strong>$object->start_date</strong>
        <p>ტრენინგი დასრულების დრო:  <strong>$object->end_date</strong>";

            return view('front.inactive', compact('page', 'content'));
        }

    $appointment = $object;


        return view('front.testDetails', compact('customer', 'page', 'appointment', 'appointmentCustomer'));
    }

    public function termsOfService()
    {
        $page = Page::where('slug', '/terms-of-service')->firstOrFail();
        $object = Policy::findOrFail(1);

        return view('front.terms', compact('page', 'object'));
    }

    public function privacyPolicy()
    {
        $page = Page::where('slug', '/privacy-policy')->firstOrFail();
        $object = Policy::findOrFail(2);

        return view('front.policy', compact('page', 'object'));
    }

    public function services()
    {
//        $page = Page::where('slug', '/services')->firstOrFail();
        $page = Page::getCachedPageBySlug('/services');
        $services = Service::orderBy('id', 'asc')->get();

        return view('front.services', compact('page', 'services'));
    }

    public function singleServices($locale, $name)
    {
        $page = Page::getCachedPageBySlug('/services');
        $services = Service::where('slug', $name)->firstOrFail();

        return view('front.singleServices', compact('page', 'services'));
    }


    public function chooseType($locale,$trainingId)
    {
        $page = Page::where('slug', '/trainings')->firstOrFail();
        $training = Training::active()->where('id', $trainingId)->firstOrFail();
        $category = Category::where('id', $training->category_id)->firstOrFail();
        return view('front.choose_type', compact('page','training', 'category'));
    }

    public function showPhysicalForm($locale, $trainingId)
    {
        $page = Page::where('slug', '/trainings')->firstOrFail();
        $training = Training::active()->where('id', $trainingId)->firstOrFail();
        $category = Category::where('id', $training->category_id)->firstOrFail();
        return view('front.choose_type_step1', compact('page','training', 'category'));

    }

    public function processType($locale,Request $request, $trainingId)
    {
        $request->validate([
            'type' => 'required|in:online,offline'
        ]);

        $training = Training::findOrFail($trainingId);
        $user = auth()->guard('external')->user(); // გარე მომხმარებელი

        if ($request->type === 'offline') {
            return redirect()->route('front.physical.form', ['locale' => app()->getLocale(), 'trainingId' => $training->id]);
//            return redirect()->route('external.dashboard')->with('success', 'ტრენინგი წარმატებით დაემატა');
        }else{
            $existingOrder = TrainingOrder::where('external_user_id', $user->id)
                ->where('training_id', $request->training_id)
                ->where('status', '!=', 'expired')
                ->where('type', '=', 'online')
                ->first();



            if ($existingOrder) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'თქვენ უკვე დარეგისტრირებული ხართ ამ ტრენინგზე!');
            }

            TrainingOrder::create([
                'external_user_id' => $user->id,
                'training_id' => $request->training_id,
                'type' => 'online',
                'status' => 'paid',
                'paid_at' => Carbon::now(),
                'access_expires_at' => Carbon::now()->addDays(config('meta.external_expire_training_day')),
            ]);

            return redirect()->route('front.dashboard', ['type' => 'online'])->with('success', 'ტრენინგი წარმატებით დაემატა');

        }

        // თუ ონლაინ აირჩია — გადამისამართება გადახდის გვერდზე
        return redirect()->route('payment.page', $training->id);
    }


    public function submitPhysical(Request $request)
    {
        $request->validate([
            'training_id' => 'required|exists:trainings,id',
            'phone' => 'required|string|max:20',
            'personal_number' => 'required|string|max:11',
        ]);

        $user = auth()->guard('external')->user();

        // Check if active order already exists
        $existingOrder = TrainingOrder::where('external_user_id', $user->id)
            ->where('training_id', $request->training_id)
            ->where('status', '!=', 'expired')
            ->where('type', '=', 'offline')
            ->first();

        if ($existingOrder) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'თქვენ უკვე დარეგისტრირებული ხართ ამ ტრენინგზე!');
        }

        // Create new order
        TrainingOrder::create([
            'external_user_id' => $user->id,
            'training_id' => $request->training_id,
            'type' => 'offline',
            'phone' => $request->phone,
            'id_number' => $request->personal_number,
            'status' => 'pending',
        ]);

        return redirect()->route('front.dashboard')
            ->with('success', 'ტრენინგი წარმატებით დაემატა');
    }



}
