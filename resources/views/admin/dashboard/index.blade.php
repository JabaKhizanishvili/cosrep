@extends('admin.layouts.app')


@section('title')

@endsection


@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{admin_styles('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{admin_styles('assets/css/widgets/modules-widgets.css')}} ">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')
<div class="layout-px-spacing">


    <!-- CONTENT AREA -->


    <div class="row analytics layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="row widget-statistic">

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-branch"><line x1="6" y1="3" x2="6" y2="15"></line><circle cx="18" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 9a9 9 0 0 1-9 9"></path></svg>                            </div>
                            <p class="w-value">{{  $number_of_trainers}}</p>
                            <h5 class=""> Number of Trainers</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="widget widget-one_hybrid widget-engagement" style="background: #feffa8">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>                            </div>
                            <p class="w-value">{{ $number_of_trainings}}</p>
                            <h5 class="">Number of Trainings</h5>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="widget widget-one_hybrid widget-referral">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>                                         </div>
                            <p class="w-value">{{ $number_of_customers }}</p>
                            <h5 class="">Number of Customers</h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2">

            <div class="container">
                <h2>Email Settings</h2>
                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif
                <form action="{{ route('admin.dashboard.update') }}" method="POST">
                    @csrf
                    <label for="email_language">Email Language:</label>
                    <select name="email_language" id="email_language">
                        <option value="en" {{ $email_language == 'en' ? 'selected' : '' }}>English</option>
                        <option value="ge" {{ $email_language == 'ge' ? 'selected' : '' }}>ქართული</option>
                    </select>
                    <button type="submit">Save</button>
                </form>
            </div>

        </div>
    </div>




    <!-- CONTENT AREA -->

</div>
@endsection


@section('script')

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{admin_styles('plugins/apex/apexcharts.min.js')}} "></script>
    <script src="{{admin_styles('assets/js/widgets/modules-widgets.js')}} "></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

@endsection
