@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <main>

        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large bg-services"
             style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ trainingImage($training->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h1>{{ $training->title }}
                        </h1>

                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                    <span class="first-item">
                                    <a href="{{ route('front.index') }}">{{__('page.main')}}</a></span>
                                <span class="separator">&gt;</span>
                                <span class="first-item">
                                <a href="{{ route('front.trainings') }}">{{ $page->name }}</a></span>
                                <span class="separator">&gt;</span>

                                <span class="first-item">
                                <a href="{{ route('front.categoryTrainings', rawurlencode($training->category->name)) }}">{{ limit_words($training->category->name, 50) }}</a></span>
                                <span class="separator">&gt;</span>


                                <span class="last-item">{{ limit_words($training->title, 50) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->


        <!-- services two area start -->
        <div id="services-two" class="wrap-bg wrap-bg-dark">
            <!-- .container -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="section-title section-text-left text-left">
                            <div>
                                <h3>{{ $training->title }}</h3>
                                <div class="bar"></div>
                                <p style="max-width: unset">{!! $training->text !!}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <br>
            <br>


            <div class="container">
                <div class="row">


                    <div class="col-lg-12 text-center">
                        <div class="feature_contact_item fc_bg2">
                            <div class="opac">
                                <h3>{{__('page.trainer')}}</h3>

                                <img src="{{ trainerImage($training->trainer->image) }}" alt=""
                                     style="width:200px; height;200px; object-fit:contain">
                                <h4 class="mt-4 text-white">{{ transliterateEn($training->trainer->name) }}</h4>
                                <p>
                                <div class="custom_contact">
                                    @if($training->trainer->facebook)
                                        <a href="{{ $training->trainer->facebook }}" target="_blank"><i
                                                class="fab fa-facebook" aria-hidden="true"></i></a>
                                    @endif

                                    @if($training->trainer->linkedin)
                                        <a href="{{ $training->trainer->linkedin }}" target="_blank"><i
                                                class="fab fa-linkedin" aria-hidden="true"></i></a>
                                    @endif

                                    @if($training->trainer->twitter)
                                        <a href="{{ $training->trainer->twitter }}" target="_blank"><i
                                                class="fab fa-twitter" aria-hidden="true"></i></a>
                                    @endif

                                    @if($training->trainer->instagram)
                                        <a href="{{ $training->trainer->instagram }}" target="_blank"><i
                                                class="fab fa-instagram" aria-hidden="true"></i></a>
                                    @endif

                                    @if($training->trainer->email)
                                        <a href="mailto:{{ $training->trainer->email }}" target="_blank"><i
                                                class="fa fa-envelope" aria-hidden="true"></i></a>
                                    @endif
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- .row end -->
            </div>


        </div>
        <!-- services two area end -->

    </main>

@endsection
