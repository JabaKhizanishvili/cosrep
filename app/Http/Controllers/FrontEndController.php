<?php

namespace App\Http\Controllers;

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

class FrontEndController extends Controller
{
    public function index()
    {
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

        $blog = Blog::where("name->" . app()->getLocale(), $name)->firstOrFail();
//        $blogs = Blog::where('id', '!=', $blog->id)->limit(5)->get();
        $blogs = Blog::where('id', '!=', $blog->id)->limit(5)->get();

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

    public function login(LoginRequest $request)
    {

        $credentials = $request->only('username', 'password');
        if (Auth::guard(AuthType::TYPE_CUSTOMER)->attempt($credentials)) {
//            return redirect(RouteServiceProvider::CUSTOMER_HOME);
            return redirect(route('front.dashboard'));
        }

        return redirect()->back()->with('error', 'Username ან Password არასწორია');
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

//       $request->validate([
//           'old_password' => ['required'],
//           'new_password' => ['required', 'min:8', 'confirmed'],
//       ], [
//           'old_password.required' => 'გთხოვთ შეიყვანოთ ძველი პაროლი.',
//           'new_password.required' => 'გთხოვთ შეიყვანოთ ახალი პაროლი.',
//           'new_password.min' => 'პაროლი უნდა შეიცავდეს მინიმუმ 8 სიმბოლოს.',
//           'new_password.confirmed' => 'ახალი პაროლი და მისი დადასტურება არ ემთხვევა.',
//       ]);

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

    public function dashboard(Request $request)
    {
//        $page = Page::where('slug', '/dashboard')->firstOrFail();
        $page = Page::getCachedPageBySlug('/dashboard');

        $customer = auth()->guard(AuthType::TYPE_CUSTOMER)->user();
        $appointments = $customer->appointments();

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


        return view('front.dashboard', compact('customer', 'page', 'appointments'));
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

        $page = Page::where('slug', '/dashboard')->firstOrFail();

        return view('front.startTraining', compact('customer', 'page', 'appointment'));
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
            $answers = json_decode($question->answers);
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
}
