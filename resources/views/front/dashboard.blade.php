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
                                                $isFuture = request('future') == 1;
                                                $isDone = request('done') == 1;
                                                $isAll = request('all') == 1;
                                                $isOpen = request('open') == 1 || (empty(request('future')) && empty(request('done')) && empty(request('all')));
                                            @endphp

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link tabItem {{ $isFuture ? 'active' : '' }}"
                                                   href="{{ Request::url() }}?future=1#events">{{__('page.future')}}</a>
                                            </li>

                                            <li class="nav-item" role="presentation"><a
                                                    class="nav-link tabItem {{ $isDone ? 'active' : '' }}"
                                                    href="{{ Request::url() }}?done=1#events">{{__('page.finished')}}</a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link tabItem {{ $isAll ? 'active' : '' }}"
                                                   href="{{ Request::url() }}?all=1#events">
                                                    {{__('page.all')}}
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link tabItem {{ $isOpen ? 'active' : '' }}"
                                                   href="{{ Request::url() }}?open=1#events">
                                                    {{__('page.current')}}
                                                </a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .row -->
                <div class="row">


                    @foreach ($appointments as $appointment)

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 course-single mb25">
                            <!-- 2 -->
                            <div class="themeioan_event">
                                <article><!-- single event start -->
                                    @if($appointment->isFinishedByCustomer())
                                        <div
                                            class="event-photo {{ $appointment->pivot->final_point >= $appointment->pivot->point_to_pass ? 'testStatusSuccess' : 'testStatusFail' }}">
                                            @else
                                                <div
                                                    class="event-photo {{ $appointment->isDone() ? 'testNeverFinished' : '' }}">
                                                    @endif
                                                    <div class="date">
                                                        <h4>
                                                            <span>{{ date('d', strtotime($appointment->start_date)) }}</span> {{ montName(date('m', strtotime($appointment->start_date))) }}
                                                            , {{ date('Y', strtotime($appointment->start_date)) }}</h4>
                                                    </div>
                                                    <img src="{{ trainingImageThumb($appointment->training->image) }}"
                                                         alt="">
                                                </div>
                                                <div class="event-content">
                                                    <h5 class="title">{{ limit_words(strip_tags($appointment->training->title), 100) }}
                                                    </h5>
                                                    <div class="course-viewer">
                                                        <ul>
                                                            <li>
                                                                <i class="fas fa-clock"></i> {{ date('H:i', strtotime($appointment->start_date)) }}
                                                                - {{ date('H:i', strtotime($appointment->end_date)) }}
                                                            </li>
                                                        </ul>
                                                        {!! $appointment->getStatus() !!}
                                                    </div>


                                                    @if(empty($appointment->pivot->finished_at))
                                                        <div class="btn-section">
                                                            @if($appointment->isOpen())
                                                                <a href="{{ route('front.startTrainingView', $appointment) }}"
                                                                   class="btn btn-success text-white pt-1 pb-1 startTrainingBtn">{{__('page.start_training')}}</a>
                                                            @else
                                                                <br>
                                                            @endif
                                                        </div>
                                                    @else

                                                        <div class="btn-section">
                                                            <a href="{{ route('front.testDetails', $appointment) }}"
                                                               class="button-light"><i
                                                                    class="fas fa-arrow-right"></i>{{__('page.test_details')}}
                                                            </a>
                                                        </div>

                                                    @endif
                                                </div>
                                </article><!-- single event end -->
                            </div>
                        </div>

                    @endforeach

                </div>
                {{ $appointments->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
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
                                                         class="float-left">{{ transliterateEn($customer->name) }}</a>
                                        <br>
                                    </h5>
                                    <p>{{__('page.email')}}: {{ $customer->email }}</p>
                                    <p>{{__('page.register_date')}}
                                        : {{ date("Y-m-d H:i", strtotime($customer->created_at)) }}</p>

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
