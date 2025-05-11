<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        CMS
    @yield('title')
    </title>
    <link rel="icon" type="image/x-icon" href="{{ admin_styles('assets/img/favicon.ico') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ admin_styles('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ admin_styles('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/elements/alert.css') }}">

    <link href="{{admin_styles('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{admin_styles('assets/css/elements/search.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/regular.css') }}">
    <link rel="stylesheet" href="{{ admin_styles('plugins/font-icons/fontawesome/css/fontawesome.css') }}">


@yield('css')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
        .navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }
        .layout-px-spacing {
            min-height: calc(100vh - 96px)!important;
        }

        .customValidate{

    color: #e7515a;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    width: 100%;
    margin-top: .25rem;
        }
        .invalideInput{
            border-color: #e7515a;
        }


        .navbar .navbar-item .nav-item.user-profile-dropdown .dropdown-menu{
            /* left: -60px; */
        }

        .fontAwesome{
            font-size: 18px;
            margin-right: 10px;
        }

        .crop-image{
        width: 100%;
    }


    .crop-wrapper .shadow{
        box-shadow: none !important;
    }

    #crop-select{
        width: 350px;
    }

    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body class="sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-item flex-row">
                <li class="nav-item align-self-center page-heading">
                    <div class="page-header">
                        <div class="page-title">
                            <h3 class="pageTitle">
                                @yield('title')
                            </h3>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-item flex-row navbar-dropdown">
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span style="font-size: 14px">{{ \Auth::user()->name }}</span>

                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="{{ route('admin.profile.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile</a>

                            </div>

                            <div class="dropdown-item">
                                <a class="" href="{{ route('admin.profile.edit') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Edit</a>
                            </div>

                            <div class="dropdown-item">
                                <a class="" href="{{ route('logout') }}"   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    logout</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="sidebar">
                    {{-- Logo link --}}
                    <ul class="navbar-nav theme-brand flex-row  text-center">
                        <li class="nav-item theme-logo">
                            <a href="{{ route('admin.dashboard.index') }}">
                                <img src="{{ admin_styles('logo.jpg') }}" class="navbar-logo" alt="logo">
                            </a>
                        </li>
                        <li class="nav-item theme-text">
                            <a href="{{ route('admin.dashboard.index') }}"> {{ config('app.name') }}</a>
                        </li>
                        <li class="nav-item toggle-sidebar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left sidebarCollapse"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        </li>
                    </ul>


                    <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                {{-- Customer Routes --}}
                @if(Auth::guard('web')->check())

                    <li class="menu">
                        <a href="#profile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle menuDropdown">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span> Profile</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="profile" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.profile.index') }}" class="menuUrl"> Profile </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile.edit') }}" class="menuUrl"> Edit </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="{{ route('admin.dashboard.index') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span> Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{ route('admin.calendar.index') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                                <span> Calendar</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>GENERAL SECTION</span></div>
                    </li>

                    <li class="menu">
                        <a href="{{ route('admin.pages.index') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    <span> Pages</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{ route('admin.contacts.edit') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <span>Contact</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{ route('admin.about.edit') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg><span>About</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu">
                        <a href="{{ route('admin.policies.index') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                <span> Terms / Policy</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="#blogs" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bold"><path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path><path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"></path></svg>
                                                                 <span>Blogs</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="blogs" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.blogs.index') }}" class="menuUrl">Blogs</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.blogs.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#services" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>                                                                 <span>Services</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="services" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.services.index') }}" class="menuUrl">Services</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.services.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>HOME SECTION</span></div>
                    </li>

                    <li class="menu">
                        <a href="#slider" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>                                <span>Slider</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="slider" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.sliders.index') }}" class="menuUrl">Slider</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sliders.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#partners" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>                                <span>Partners</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="partners" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.partners.index') }}" class="menuUrl">Partners</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.partners.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="{{ route('admin.sections.index') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>                                                 <span>Sections</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>CUSTOMERS SECTION</span></div>
                    </li>

                    <li class="menu">
                        <a href="#positions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>                                <span>Positions</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="positions" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.positions.index') }}" class="menuUrl">Positions</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.positions.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#organizations" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                <span>organizations</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="organizations" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.organizations.index') }}" class="menuUrl">organizations</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.organizations.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#offices" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>Offices</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="offices" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.offices.index') }}" class="menuUrl">Offices</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.offices.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                   <span> Customers</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="customers" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.customers.index') }}" class="menuUrl"> Customers </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.customers.create') }}" class="menuUrl"> Add </a>
                            </li>

                        </ul>
                    </li>


                    <li class="menu">
                        <a href="{{ route('admin.logs') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink" target="_blank">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>                                    <span>Logs</span>
                            </div>
                        </a>
                    </li>


                    <li class="menu">
                        <a href="{{ route('admin.orders.index') }}" aria-expanded="false" class="dropdown-toggle menuUrl singleLink" target="">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <span>Orders</span>
                            </div>

                        </a>
                    </li>


                    <li class="menu menu-heading">
                        <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span>TRAININGS SECTION</span></div>
                    </li>


                    <li class="menu">
                        <a href="#packages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>                                <span>Categories</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="packages" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.categories.index') }}" class="menuUrl">Categories </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#trainers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                   <span> Trainers</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="trainers" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.trainers.index') }}" class="menuUrl"> Trainers </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.trainers.create') }}" class="menuUrl"> Add </a>
                            </li>

                        </ul>
                    </li>


                    <li class="menu">
                        <a href="#trainings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>                                   <span> Trainings</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="trainings" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.trainings.index') }}" class="menuUrl"> Trainings </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.trainings.create') }}" class="menuUrl"> Add </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#appointments" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                                <span> Appointments</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="appointments" data-parent="#accordionExample">
                            <li>
                                <a href="{{ route('admin.appointments.index') }}" class="menuUrl"> Appointments </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.appointments.create') }}" class="menuUrl"> Add </a>
                            </li>
{{--
                            <li>
                                <a href="{{ route('admin.appointments.repeatView') }}" class="menuUrl"> Repeat </a>
                            </li> --}}
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>

    </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')
            </div>



            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ admin_styles('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ admin_styles('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ admin_styles('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ admin_styles('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ admin_styles('assets/js/app.js') }}"></script>
    <script src="{{ admin_styles('plugins/fullcalendar/moment.min.js') }}"></script>
    <script src="{{ admin_styles('plugins/blockui/jquery.blockUI.min.js') }}"></script>
    <script src="{{ admin_styles('plugins/blockui/custom-blockui.js') }}"></script>
    <script src="{{ admin_styles('assets/js/custom.js') }}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{admin_styles('plugins/notification/snackbar/snackbar.min.js')}}"></script>

    @yield('script')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


    <script>

    window.addEventListener('DOMContentLoaded', (event) => {
        const submitForm = document.getElementById('submitForm');
        const submitButton = document.getElementById('submitButton');
        if(submitForm != null && submitButton != null){
            submitForm.addEventListener('submit', function(){
                submitButton.disabled = true;
            });
        }
    });

        document.addEventListener('DOMContentLoaded', function(){

            //Succes and error messages
            @if(session('success'))
                Snackbar.show({
                    text: '{{session('success')}}',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42',
                    pos: 'bottom-right'
                });
            @endif


            @if(session('error'))
                Snackbar.show({
                    text: '{{session('error')}}',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'bottom-right',
                    duration: null
                });
            @endif


                    var app_url = window.location.pathname.split('/admin/')[1];


                    var nested = '';




                    if(app_url.includes('/edit')){
                        nested = app_url.split('/')[0]
                    }

                    if(app_url.includes('/show')){
                        nested = app_url.split('/')[0]
                    }

                    if(app_url.includes('trainings')){
                        nested = 'trainings';
                    }

                    if(app_url.includes('customers/')){
                        nested = 'customers';
                    }

                    if(app_url.includes('appointments/')){
                        nested = 'appointments';
                    }

                    if(app_url.includes('transactions/')){
                        nested = 'transactions';
                    }

                    var menuUrl = document.querySelectorAll('.menuUrl');
                    menuUrl.forEach(element => {

                        let url = element.getAttribute('href').split('/admin/')[1];


                        if(app_url == url){
                            if(element.classList.contains('singleLink')){
                                element.parentNode.classList.add('active')
                                element.setAttribute('aria-expanded', true);
                            }else {
                                element.parentNode.parentNode.parentNode.classList.add('active')
                                element.parentNode.parentNode.classList.add('show')
                                element.parentNode.classList.add('active')
                                element.parentNode.parentNode.parentNode.childNodes[1].setAttribute('aria-expanded', true);


                            }
                        }else if(url == nested){
                            if(element.classList.contains('singleLink')){
                                element.parentNode.classList.add('active')
                                element.setAttribute('aria-expanded', true);
                            }else {
                            element.parentNode.parentNode.parentNode.classList.add('active')
                            element.parentNode.parentNode.classList.add('show')
                            element.parentNode.parentNode.parentNode.childNodes[1].setAttribute('aria-expanded', true);

                            }

                        }

                    });

                    App.init();

                });
            </script>
</body>
</html>
