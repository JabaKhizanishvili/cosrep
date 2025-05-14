@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{ front_styles('css/tab.css') }}?v=2">
    <style>
        .startTrainingBtn {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            background: transparent;
            border: 2px solid #28a745;
            border-color: #28a745 !important;
            color: #2D323D !important;
            box-shadow: rgb(50 50 93 / 25%) 0px 2px 5px -1px;
        }

        .startTrainingBtn:hover {
            background: #28a745;
            color: #fff !important;

        }

        .testStatusFail:after {
            content: "{{ __('page.unsuccessful') }}";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(220, 53, 69, 0.7);
            width: 100%;
            height: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            color: #fff;
            z-index: 1;
        }

        .testStatusSuccess:after {
            content: "{{__('page.successful')}}";
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            background-color: rgba(40, 167, 69, 0.5);
            width: 100%;
            height: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            color: #fff;
            z-index: 1;
        }

        .testNeverFinished:after {
            content: "{{__('page.testneverfinished')}}";
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            background-color: rgba(220, 53, 69, 0.7);
            width: 100%;
            height: 30%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            color: #fff;
            z-index: 1;
        }

    </style>
@endsection

@section('content')

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large"
             style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ pageImage($page->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h1>{{ $page->name }}</h1>
                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                        <span class="first-item">
                                        <a href="{{ route('front.index') }}">
                                            {{__('page.main')}}
                                        </a></span>
                                <span class="separator">&gt;</span>
                                <span class="last-item">{{ $page->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->


        <!-- contact area start -->
        <div id="events" class="wrap-bg">
            @if(!empty($certificates))
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">
                            <div class="section-title with-p">
                                <h2>
                                    {{__('page.certificates')}}

                                </h2>
                                <div class="bar"></div>
                                {{-- <p>We can help you create positive and permanent changes in your life. Let’s Create Something new and awesome Togeather. --}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container row mx-auto mb-5">
                    @foreach($certificates as $key => $certificate)

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 course-single mb25">

                            <div class="themeioan_event">
                                <div class="event-photo" >
                                    <iframe src="{{ asset('storage/certificates/' . basename($certificate->file_path)) }}" class="w-100" style="min-height: 250px" >
                                        This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('storage/certificates/' . basename($certificate->file_path)) }}">Download PDF</a>
                                    </iframe>
                                </div>

                                <div class="event-content" style="min-height: 200px">
                                    <h5 class="title">{{ limit_words(strip_tags($certificate->training->title), 100) }}
                                    </h5>

                                    <div class="course-viewer">
                                        <ul>
                                        </ul>
                                        {{-- {!! $value->getStatus() !!} --}}
                                    </div>


                                        <div class="btn-section">
{{--                                            <a href="{{ route('front.testDetailsForExternal', $certificate) }}"--}}
{{--                                               class="button-light"><i--}}
{{--                                                    class="fas fa-arrow-right"></i>{{__('page.test_details')}}--}}
{{--                                            </a>--}}
                                            <a href="{{ route('front.downloadCertificate', $certificate->id) }}"
                                                                               class="btn btn-light">
                                                                                <i class="fas fa-download mr-1"></i> გადმოწერა
                                                                            </a>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            <div class="container">

                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="section-title with-p">
                            <h2>
                                {{__('page.mytraining')}}

                            </h2>
                            <div class="bar"></div>
                            {{-- <p>We can help you create positive and permanent changes in your life. Let’s Create Something new and awesome Togeather. --}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div id="accordion" style="margin-bottom: 50px">
                            <div class="tabs-to-dropdown">
                                <div class="nav-wrapper tabHeader d-flex align-items-center justify-content-between">

                                    <ul class="nav nav-pills d-md-flex" id="pills-tab" role="tablist">
                                        <ul class="nav nav-pills d-md-flex" id="pills-tab" role="tablist">
                                            @php
                                                $currentType = request('type', 'offline');
                                            @endphp


{{--                                            <li class="nav-item" role="presentation">--}}
{{--                                                <a class="nav-link tabItem active"--}}
{{--                                                   --}}{{--                                                   href="{{ Request::url() }}?open=1#events"--}}
{{--                                                   href="{{ Request::url() }}"--}}
{{--                                                >--}}
{{--                                                    {{__('page.current')}}--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link tabItem {{ $currentType == 'offline' ? 'active' : '' }}"
                                                   href="{{ Request::url() }}?type=offline">{{__('page.training_type1')}}</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link tabItem {{ $currentType == 'online' ? 'active' : '' }}"
                                                   href="{{ Request::url() }}?type=online">{{__('page.training_type2')}}</a>
                                            </li>
                                        </ul>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <!-- .row -->
                <div class="container row">
                    @foreach($trainings as $key => $value)
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 course-single mb25">

                    <div class="themeioan_event">
                        <div class="event-photo
                         @if($value->type == 'online')
                            @if(!empty($value->finished_at))
                             {{ $value->final_point >= $value->point_to_pass ? 'testStatusSuccess' : 'testStatusFail' }}
                            @endif
                         @endif
                         " >
                            <div class="date">
                                <h4>
                                    <span>{{ date('d', strtotime($value->paid_at)) }}</span> {{ montName(date('m', strtotime($value->paid_at))) }}
                                    , {{ date('Y', strtotime($value->paid_at)) }}</h4>
                            </div>
                            <img src="{{ trainingImageThumb($value->training->image) }}"
                                 alt="">
                        </div>

                        <div class="event-content" style="min-height: 200px">
                            <h5 class="title">{{ limit_words(strip_tags($value->training->title), 100) }}
                            </h5>

                            <div class="course-viewer">
                                <ul>
                                    <li>
                                        <i class="fas fa-calendar"></i>
                                        {{ formatTranslatedDate($value->payed_at) }}
                                        -
                                        {{ formatTranslatedDate($value->access_expires_at) }}
                                    </li>
                                </ul>
                                {{-- {!! $value->getStatus() !!} --}}
                            </div>

                            @if(empty($value->finished_at ))
                                <div class="btn-section">
                                    @if($value->isOpen())
                                        @if(auth()->guard(\App\Services\AuthType::TYPE_EXTERNAL_CUSTOMER)->check())
                                            <a href="{{ route('front.startExternalTrainingView', $value) }}"
                                               class="btn btn-success text-white pt-1 pb-1 startTrainingBtn">{{__('page.start_training')}}</a>
                                        @else
                                            <a href="{{ route('front.startTrainingView', $value) }}"
                                               class="btn btn-success text-white pt-1 pb-1 startTrainingBtn">{{__('page.start_training')}}</a>
                                        @endif

                                    @else
                                        <br>
                                    @endif
                                </div>
                            @else
                                    <div class="btn-section">
                                        <a href="{{ route('front.testDetailsForExternal', $value) }}"
                                           class="button-light"><i
                                                class="fas fa-arrow-right"></i>{{__('page.test_details')}}
                                        </a>
                                    </div>
                            @endif
                        </div>
                    </div>
                    </div>
                    @endforeach


                </div>
                {{ $trainings->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
                <!-- .row end -->
            </div>
        </div>
        <!-- contact area end -->

        <div id="projects" style="margin-bottom: 100px">
            <div class="container">
                <!-- .row -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 course-single mb25">
                        <!-- 1 -->
                        <div class="themeioan_services">
                            <article><!-- single services -->
                                <div class="blog-content">

                                    <h5 class="title"><a href="services-detail.html"
                                                         class="float-left">{{ transliterateEn($user->name) }}</a>
                                        <br>
                                    </h5>
                                    <p>{{__('page.email')}}: {{ $user->email }}</p>
                                    <p>{{__('page.register_date')}}
                                        : {{ date("Y-m-d H:i", strtotime($user->created_at)) }}</p>

                                    {{-- <div class="mt-25">
                                        <a href="services-detail.html" class="button-light"><i class="fas fa-arrow-right"></i> Read More</a>
                                    </div> --}}
                                </div>
                            </article><!-- end single services -->
                        </div>
                    </div>

                </div>
                <!-- .row end -->
            </div>
        </div>

    </main>

@endsection
