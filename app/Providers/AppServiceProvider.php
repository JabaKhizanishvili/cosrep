<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Policy;
use App\Models\Contact;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer([
            'front.index',
            'front.trainings',
            'front.categories',
            'front.about',
            'front.contact',
            'front.blogs',
            'front.login',
            'front.singleBlog',
            'front.singleTraining',
            'front.terms',
            'front.policy',
            'front.choose_type',
            'front.dashboard',
            'front.external_dashboard',
            'front.startTraining',
            'front.startTest',
            'front.testDetails',
            'front.inactive',
            'front.services',
            'front.forgetPassword',
            'front.forgetPasswordLink',
            'front.changePasswordView',
            'front.singleServices',
            'front.externalRegister',

        ], function ($view) {

//            $pages = Page::active()->display()->orderBy('position', 'asc')->get();
            $pages = Page::getCachedMenuPages();
            $policies = Page::policies()->get();
            $cookie = Policy::findOrFail(3);

//            $contact = Contact::first();
            $contact = Contact::getCachedContact();
            $view->with(['pages' => $pages, 'contact' => $contact, 'cookie' => $cookie, 'policies' => $policies]);
        });
    }
}
