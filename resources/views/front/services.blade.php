@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <style>
        #accordion ul {
            list-style: disc !important;
            list-style-position: initial !important;
            list-style-image: initial !important;
            list-style-type: disc !important;
            list-style-type: disc !important;
            margin-block-start: 1em !important;
            margin-block-end: 1em !important;
            margin-inline-start: 0px !important;
            margin-inline-end: 0px !important;
            padding-inline-start: 40px !important;
        }

        #accordion li {
            list-style: disc;
            font-weight: 500;
        }

        }
    </style>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
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
                                        <a href="{{ route('front.index') }}">{{__('page.main')}}</a></span>
                                <span class="separator">&gt;</span>
                                <span class="last-item">{{ $page->getTranslation('name', app()->getLocale()) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->

        <!-- accordion area start -->
        <div id="accordion-container" class="wrap-bg wrap-bg-dark">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="section-title with-p">
                            <h2>{{__('page.our_services')}}</h2>
                            <div class="bar"></div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                    </div>
                    <div class="col-md-6 col-lg-12">
                        <div id="accordion">
                            @foreach ($services as $key =>$service)

                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="mb-0">
                                            <div class="btn btn-link" role="button" data-toggle="collapse"
                                                 data-target="#service_{{ $service->id }}" aria-expanded="true"
                                                 aria-controls="service_{{ $service->id }}">
                                                {{ $service->name }}
                                            </div>
                                        </div>
                                    </div>

                                    <div id="service_{{ $service->id }}" class="collapse {{ $key == 0 ?'show' : '' }}"
                                         aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="">
                                            <div class="card-body m-4 p-4 text-justify shadow  mb-5 bg-body rounded"
                                                 style="min-height: auto; overflow: hidden;">
                                                {!! $service->text !!}
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            @endforeach

                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                    </div>
                </div>
            </div>
        </div>
        <!-- accordion area end -->
    </main>

@endsection
