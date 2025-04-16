@extends('front.layouts.app')


@section('title')

@endsection


@section('css')
    <style>
        .custom-singleservice p{
            font-size: 1rem;

        }

        .ck-content ul {
            list-style-type: disc !important;
            padding-left: 1vh;
            display: block !important;
        }

        /*.ck-content li::before {*/
        /*    content: unset !important;*/
        /*}*/

        .ck-content ul li {
            list-style-type: disc !important;
            list-style-position: inside !important;
            display: list-item !important;
        }

        .ck-content ol {
            list-style-type: decimal;
            padding-left: 20px;
        }
    </style>

<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

<main>
    <!-- breadcrumb banner content area start -->
    <div class="image-overly-dark lernen_banner large bg-blog-detail2"
         style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ pageImage($page->image) }});">
        <div class="container opac">
            <div class="row">
                <div class="lernen_banner_title">
                    <h1>{{ $services->name }}</h1>
                    <div class="lernen_breadcrumb">
                        <div class="breadcrumbs">
                                <span class="first-item">
                                <a href="{{ route('front.index') }}">{{__('page.main')}}</a></span>
                            <span class="separator">&gt;</span>

                            <span class="first-item">
                            <a href="{{ route('front.services') }}">{{ $page->name }}</a></span>
                            <span class="separator">&gt;</span>


                            <span class="last-item">{{ limit_words($services->name, 50) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb banner content area start -->

    <!-- Blog Detail area start -->
    <div id="blog-detail" class="wrap-bg wrap-bg ">
        <div class="container">
            <div class="row">
                <!-- Content Left -->
                <div class="col-md-12 col-lg-12">
                    <div class="blog-content">
                        <div class="blog-detail-img text-center">
                            <img class="mb-4" style="height: 30vw; width: auto" src="{{ ServicesImage($services->image) }}" alt="{{ $services->name }}"/>
                        </div>
                        <div class="section-title text-center">
                            <div>
                                <h3>{{ $services->name }}</h3>
                            </div>
                        </div>

{{--                        <div class="mt-5 custom-singleservice ck-content" style="color: #0b0b0b;}">--}}
                            <div class="mt-5 custom-singleservice ck-content" style="color: #0b0b0b;">

                            {!! $services->text !!}
{{--                            {!! Purifier::clean($services->text) !!}--}}
                        </div>


                    </div>
                </div>


                <!-- Sidebar Right -->

            </div>
        </div>
    </div>
    <!-- Blog Detail area end -->
</main>

@endsection
