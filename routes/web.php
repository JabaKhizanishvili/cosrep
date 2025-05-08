<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ExternalAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/a', function(){
//     return view('admin.appointments.pdf_');
// });


Route::get('/admin', function () {
    return redirect('admin/login');
});


Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['verify' => true, 'register' => false]);
});


Route::prefix('admin')->middleware(['auth:web', 'verified'])->group(function () {

    //admin routes
    Route::get('profile', [AdminController::class, 'index'])->name('admin.profile.index');
    Route::get('profile/edit', [AdminController::class, 'edit'])->name('admin.profile.edit');
    Route::put('profile/edit', [AdminController::class, 'update'])->name('admin.profile.update');


    Route::get('calendar/index', [CalendarController::class, 'index'])->name('admin.calendar.index');

    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::post('dashboard/settings/update', [DashboardController::class, 'update'])->name('admin.dashboard.update');


    //Pages Routes
    Route::get('pages', [PageController::class, 'index'])->name('admin.pages.index');
    Route::get('pages/{object}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::put('pages/{object}/edit', [PageController::class, 'update'])->name('admin.pages.update');
    Route::post('pages/position', [PageController::class, 'position'])->name('admin.pages.position');

    //contact routes
    Route::get('contacts', [ContactController::class, 'edit'])->name('admin.contacts.edit');
    Route::put('contacts/{object}', [ContactController::class, 'update'])->name('admin.contacts.update');


    //contact routes
    Route::get('about', [AboutController::class, 'edit'])->name('admin.about.edit');
    Route::put('about/{object}', [AboutController::class, 'update'])->name('admin.about.update');


    //organization Routes
    Route::get('organizations', [OrganizationController::class, 'index'])->name('admin.organizations.index');
    Route::get('organizations/create', [OrganizationController::class, 'create'])->name('admin.organizations.create');
    Route::post('organizations/create', [OrganizationController::class, 'store'])->name('admin.organizations.store');
    Route::get('organizations/{object}/edit', [OrganizationController::class, 'edit'])->name('admin.organizations.edit');
    Route::put('organizations/{object}/edit', [OrganizationController::class, 'update'])->name('admin.organizations.update');
    Route::delete('organizations/{object}', [OrganizationController::class, 'destroy'])->name('admin.organizations.destroy');


    //positions Routes
    Route::get('positions', [PositionController::class, 'index'])->name('admin.positions.index');
    Route::get('positions/create', [PositionController::class, 'create'])->name('admin.positions.create');
    Route::post('positions/create', [PositionController::class, 'store'])->name('admin.positions.store');
    Route::get('positions/{object}/edit', [PositionController::class, 'edit'])->name('admin.positions.edit');
    Route::put('positions/{object}/edit', [PositionController::class, 'update'])->name('admin.positions.update');
    Route::delete('positions/{object}', [PositionController::class, 'destroy'])->name('admin.positions.destroy');

    //office Routes
    Route::get('offices', [OfficeController::class, 'index'])->name('admin.offices.index');
    Route::get('offices/create', [OfficeController::class, 'create'])->name('admin.offices.create');
    Route::post('offices/create', [OfficeController::class, 'store'])->name('admin.offices.store');
    Route::get('offices/{object}/edit', [OfficeController::class, 'edit'])->name('admin.offices.edit');
    Route::put('offices/{object}/edit', [OfficeController::class, 'update'])->name('admin.offices.update');
    Route::delete('offices/{object}', [OfficeController::class, 'destroy'])->name('admin.offices.destroy');
    Route::post('offices/mass-delete', [OfficeController::class, 'massDelete'])->name('admin.offices.massDelete');


    //customers Routes
    Route::get('customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
    Route::post('customers/create', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::get('customers/{object}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('customers/{object}/edit', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('customers/{object}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
    Route::get('customers/getOffices', [CustomerController::class, 'getOffices'])->name('admin.customers.getOffices');
    Route::get('customers/importView', [CustomerController::class, 'importView'])->name('admin.customers.importView');
    Route::post('customers/import', [CustomerController::class, 'import'])->name('admin.customers.import');
    Route::put('customers/{object}/updateGroup', [CustomerController::class, 'updateGroup'])->name('admin.customers.updateGroup');
    Route::post('customers/mass-delete', [CustomerController::class, 'massDelete'])->name('admin.customers.massDelete');


    //Categories Routes
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories/create', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{object}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{object}/edit', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{object}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::post('categories/position', [CategoryController::class, 'position'])->name('admin.categories.position');

    //sliders route
    Route::get('sliders', [SliderController::class, 'index'])->name('admin.sliders.index');
    Route::get('sliders/create', [SliderController::class, 'create'])->name('admin.sliders.create');
    Route::post('sliders/create', [SliderController::class, 'store'])->name('admin.sliders.store');
    Route::get('sliders/{object}/edit', [SliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::put('sliders/{object}/edit', [SliderController::class, 'update'])->name('admin.sliders.update');
    Route::post('sliders/position', [SliderController::class, 'position'])->name('admin.sliders.position');
    Route::delete('sliders/{object}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');

    //customers Routes
    Route::get('trainers', [TrainerController::class, 'index'])->name('admin.trainers.index');
    Route::get('trainers/create', [TrainerController::class, 'create'])->name('admin.trainers.create');
    Route::post('trainers/create', [TrainerController::class, 'store'])->name('admin.trainers.store');
    Route::get('trainers/{object}/edit', [TrainerController::class, 'edit'])->name('admin.trainers.edit');
    Route::put('trainers/{object}/edit', [TrainerController::class, 'update'])->name('admin.trainers.update');
    Route::delete('trainers/{object}', [TrainerController::class, 'destroy'])->name('admin.trainers.destroy');


    //customers Routes
    Route::get('partners', [PartnerController::class, 'index'])->name('admin.partners.index');
    Route::get('partners/create', [PartnerController::class, 'create'])->name('admin.partners.create');
    Route::post('partners/create', [PartnerController::class, 'store'])->name('admin.partners.store');
    Route::get('partners/{object}/edit', [PartnerController::class, 'edit'])->name('admin.partners.edit');
    Route::put('partners/{object}/edit', [PartnerController::class, 'update'])->name('admin.partners.update');
    Route::delete('partners/{object}', [PartnerController::class, 'destroy'])->name('admin.partners.destroy');

    //customers Routes
    Route::get('trainings', [TrainingController::class, 'index'])->name('admin.trainings.index');
    Route::get('trainings/create', [TrainingController::class, 'create'])->name('admin.trainings.create');
    Route::post('trainings/create', [TrainingController::class, 'store'])->name('admin.trainings.store');
    Route::get('trainings/{object}/edit', [TrainingController::class, 'edit'])->name('admin.trainings.edit');
    Route::put('trainings/{object}/edit', [TrainingController::class, 'update'])->name('admin.trainings.update');
    Route::delete('trainings/{object}', [TrainingController::class, 'destroy'])->name('admin.trainings.destroy');
    Route::get('trainings/{object}/customers', [TrainingController::class, 'trainingCustomers'])->name('admin.trainings.customers');


    Route::get('trainings/{object}/testView', [TrainingController::class, 'testView'])->name('admin.trainings.testView');
    Route::post('trainings/{object}/addQuestion', [TrainingController::class, 'addQuestion'])->name('admin.trainings.addQuestion');
    Route::get('trainings/{object}/deleteQuestion', [TrainingController::class, 'deleteQuestion'])->name('admin.trainings.deleteQuestion');
    Route::put('trainings/{object}/updateQuestion', [TrainingController::class, 'updateQuestion'])->name('admin.trainings.updateQuestion');

    Route::get('trainings/{object}/mediaView', [TrainingController::class, 'mediaView'])->name('admin.trainings.mediaView');


    Route::post('trainings/media', [TrainingController::class, 'media'])->name('admin.trainings.media');
    Route::get('trainings/{object}/deleteMedia', [TrainingController::class, 'deleteMedia'])->name('admin.trainings.deleteMedia');

    Route::put('trainings/{object}/updateMedia', [TrainingController::class, 'updateMedia'])->name('admin.trainings.updateMedia');
    Route::post('trainings/position', [TrainingController::class, 'position'])->name('admin.media.position');

    Route::get('generate-pdf', [AppointmentController::class, 'generatePDF'])->name('admin.appointments.generatePdf');


    //blog Routes
    Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('blogs/create', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('blogs/{object}/edit', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('blogs/{object}/edit', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('blogs/{object}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');

    //blog Routes
    Route::get('services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('services/create', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::post('services/image', [ServiceController::class, 'uploadImage'])->name('admin.services.uploadMedia');
    Route::get('services/imagebrowse', [ServiceController::class, 'browseMedia'])->name('admin.services.browseMedia');
    Route::get('services/{object}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('services/{object}/edit', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('services/{object}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');


    //sections
    Route::get('sections', [SectionController::class, 'index'])->name('admin.sections.index');
    Route::get('sections/{object}/edit', [SectionController::class, 'edit'])->name('admin.sections.edit');
    Route::put('sections/{object}/edit', [SectionController::class, 'update'])->name('admin.sections.update');


    //policies Routes
    Route::get('policies', [PolicyController::class, 'index'])->name('admin.policies.index');
    Route::get('policies/{object}/edit', [PolicyController::class, 'edit'])->name('admin.policies.edit');
    Route::put('policies/{object}/edit', [PolicyController::class, 'update'])->name('admin.policies.update');


    //appointments Routes
    Route::get('appointments', [AppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::get('appointments/create', [AppointmentController::class, 'create'])->name('admin.appointments.create');
    Route::post('appointments/create', [AppointmentController::class, 'store'])->name('admin.appointments.store');

    Route::post('appointments/{object}/resend', [AppointmentController::class, 'resend'])->name('admin.appointments.resend');


    Route::get('appointments/{object}/edit', [AppointmentController::class, 'edit'])->name('admin.appointments.edit');
    Route::put('appointments/{object}/edit', [AppointmentController::class, 'update'])->name('admin.appointments.update');
    Route::delete('appointments/{object}/delete', [AppointmentController::class, 'destroy'])->name('admin.appointments.destroy');
    // Route::get('appointments/repeatView', [AppointmentController::class, 'repeatView'])->name('admin.appointments.repeatView');
    // Route::get('appointments/{object}/repeat', [AppointmentController::class, 'repeat'])->name('admin.appointments.repeat');
    Route::get('appointments/{object}/registeredCustomers', [AppointmentController::class, 'registeredCustomers'])->name('admin.appointments.registeredCustomers');
    Route::get('appointments/{object}/registerCustomersView', [AppointmentController::class, 'registerCustomersView'])->name('admin.appointments.registerCustomersView');
    Route::post('appointments/{object}/registerCustomers', [AppointmentController::class, 'registerCustomers'])->name('admin.appointments.registerCustomers');

    Route::delete('appointments/{object}/deleteRegisteredCustomer', [AppointmentController::class, 'deleteRegisteredCustomer'])->name('admin.appointments.deleteRegisteredCustomer');

    Route::get('appointments/{object}/result', [AppointmentController::class, 'testResult'])->name('admin.appointments.result');


    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('admin.logs');
});

//FrontEnd Routes

Route::redirect('', config('app.fallback_locale'));
Route::prefix('{locale?}')
    ->middleware(['setlocale'])
    ->group(function () {
        Route::get('/', [FrontEndController::class, 'index'])->name(('front.index'));
        Route::get('/contact', [FrontEndController::class, 'contact'])->name(('front.contact'));
        Route::post('/send', [FrontEndController::class, 'sendEmail'])->name(('front.sendEmail'));
        Route::get('/about-us', [FrontEndController::class, 'about'])->name(('front.about'));
        Route::get('/trainings', [FrontEndController::class, 'trainings'])->name(('front.trainings'));
        Route::get('/trainings/{name}', [FrontEndController::class, 'categoryTrainings'])->name(('front.categoryTrainings'));
        Route::get('/blogs', [FrontEndController::class, 'blogs'])->name(('front.blogs'));
        Route::get('/blogs/{name}', [FrontEndController::class, 'singleBlog'])->name(('front.singleBlog'));
        Route::get('/training/{name}', [FrontEndController::class, 'singleTraining'])->name(('front.singleTraining'));
        Route::get('/login', [FrontEndController::class, 'loginView'])->name(('front.loginView'));
        Route::post('/login', [FrontEndController::class, 'login'])->name(('front.login'));
        Route::get('/terms-of-service', [FrontEndController::class, 'termsOfService'])->name(('front.terms'));
        Route::get('/privacy-policy', [FrontEndController::class, 'privacyPolicy'])->name(('front.privacy'));
        Route::get('/services', [FrontEndController::class, 'services'])->name(('front.services'));
        Route::get('/services/{name}', [FrontEndController::class, 'singleServices'])->name(('front.singleServices'));


//forgot password routes
        Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


        //register for external users

        Route::get('register', [FrontEndController::class, 'Register'])->name('auth.register_user');
        Route::post('register', [FrontEndController::class, 'Register_user'])->name('auth.register_user_');

       //end for exrernnal users routes

        // Socialite
        Route::get('auth/google', [ExternalAuthController::class, 'redirectToProvider'])->name('external.social.redirect');
//        Route::get('auth/{provider}/callback', [ExternalAuthController::class, 'handleProviderCallback'])->name('external.social.callback');
        Route::get('auth/google/callback', [ExternalAuthController::class, 'callback'])->name('external.social.callback');

        Route::get('auth/linkedin', [ExternalAuthController::class, 'linkedinRedirect'])->name('redirectToLinkedIn');
        Route::get('auth/linkedin/callback', [ExternalAuthController::class, 'linkedinCallback'])->name('handleLinkedInCallback');

        Route::middleware(['auth:customer,external'])->group(function () {

            Route::get('start-training/{object}', [FrontEndController::class, 'startTrainingView'])
                ->name('front.startTrainingView');

            Route::get('start-test/{object}', [FrontEndController::class, 'startTestView'])->name('front.startTestView');
            Route::post('end-test/{object}', [FrontEndControllerara::class, 'endTest'])->name('front.EndTest');

            Route::post('/trainer-message/{object}', [FrontEndController::class, 'sendTrainerMessage'])->name(('front.sendTrainerMessage'));

            Route::get('dashboard', [FrontEndController::class, 'dashboard'])->name('front.dashboard');
            Route::get('change_password', [FrontEndController::class, 'changePasswordView'])->name('front.changePasswordView');
            Route::post('change_password', [FrontEndController::class, 'changePassword'])->name('front.changePassword');
            Route::get('test-details/{object}', [FrontEndController::class, 'testDetails'])->name('front.testDetails');
            Route::post('/logout', function () {
                Auth::guard('customer')->logout();
                Auth::guard('external')->logout();
                return redirect()->route('front.login');
            })->name('front.logout');

        });



//        Route::middleware(['auth:external'])->group(function () {
//            // იგივე როუტები external-ისთვის
//            Route::post('/logout', function () {
//                if (Auth::guard('external')->check()) {
//                    Auth::guard('external')->logout();
//                }
//
//                return redirect()->route('front.login');
//            })->name('front.logout');
//        });


    });

