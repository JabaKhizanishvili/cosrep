@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large bg-project2"
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
                                <span class="last-item">{{ $page->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->

        <!-- projects area start -->
        <div id="projects" class="wrap-bg">
            <div class="container">
                <!-- .row -->
                <div class="row">
                    @foreach ($categories as $category)

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 course-single mb25">
                            <!-- 1 -->
                            <div class="themeioan_services">
                                <article><!-- single services -->
                                    <div class="blog-photo">
                                        <a href="{{ route('front.categoryTrainings', rawurlencode($category->name)) }}"><img
                                                src="{{ categoryImageThumb($category->image) }}" alt=""
                                                style="width: 100%; height:300px; object-fit:cover"></a>
                                    </div>
                                    <div class="blog-content" style="min-height: 207px">
                                        <h5 class="title"><a
                                                href="{{ route('front.categoryTrainings', rawurlencode($category->name)) }}">{{ limit_words($category->title, 100) }}
                                                ({{ $category->front_trainings_count }})</a>
                                        </h5>
                                    </div>
                                </article><!-- end single services -->
                            </div>
                        </div>
                    @endforeach


                </div>
                <!-- .row end -->

                <!-- .navigation start -->
                {{ $categories->appends($_GET)->links('vendor.pagination.bootstrap-4') }}

            </div>
        </div>
        <!-- projects area end -->


    </main>

@endsection
