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
             style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ categoryImage($category->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h1>{{ $category->title }}</h1>

                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                        <span class="first-item">
                                        <a href="{{ route('front.index') }}">{{__('page.main')}}</a></span>
                                <span class="separator">&gt;</span>
                                <span class="first-item">
                                    <a href="{{ route('front.trainings') }}">{{ $page->name }}</a></span>
                                <span class="separator">&gt;</span>

                                <span class="last-item">{{ limit_words($category->title, 50) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->

        <!-- services image area start -->
        <div id="services_image" class="wrap-bg">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="section-title with-p">
                            <h2>{{ $page->name }}</h2>
                            <div class="bar"></div>
                            {{-- <p>Let’s Create Something new and awesome Togeather. We can help you create positive and permanent changes in your life today. --}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($trainings as $training)
                        <div class="col-lg-4">
                            <div class="services_image services_bg4 hoverblack"
                                 style="background: url({{ trainingImageThumb($training->image) }}); backgroun-size:cover">
                                <div class="opac">
                                    <h3>{{ $training->title }}</h3>
                                    <p>{{ limit_words(strip_tags($training->text), 100) }}</p>
                                    <a href="{{ route('front.singleTraining', rawurlencode($training->name)) }}"
                                       class="color-one btn-custom">{{__('page.gadasvla')}} <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- .navigation start -->
                {{ $trainings->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <!-- services image area end -->
    </main>

@endsection
