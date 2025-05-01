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

{{--        <div id="projects" class="wrap-bg">--}}
{{--            <div class="container">--}}
{{--                <!-- .row -->--}}
{{--                    @foreach ($categories as $category)--}}

{{--                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 course-single mb25">--}}
{{--                            <!-- 1 -->--}}
{{--                            <div class="themeioan_services">--}}
{{--                                <article><!-- single services -->--}}
{{--                                    <div class="blog-photo">--}}
{{--                                        <a href="{{ route('front.categoryTrainings', rawurlencode($category->name)) }}"><img--}}
{{--                                                src="{{ categoryImageThumb($category->image) }}" alt=""--}}
{{--                                                style="width: 100%; height:auto; object-fit:none"></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="blog-content" style="min-height: 207px">--}}
{{--                                        <h5 class="title"><a--}}
{{--                                                href="{{ route('front.categoryTrainings', rawurlencode($category->name)) }}">{{ limit_words($category->title, 100) }}--}}
{{--                                                ({{ $category->front_trainings_count }})</a>--}}
{{--                                        </h5>--}}
{{--                                    </div>--}}
{{--                                </article><!-- end single services -->--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

{{--                </div>--}}
                <!-- .row end -->

                <!-- .navigation start -->
        <div id="projects" class="wrap-bg">
            <div class="container">
                <div class="accordion" id="categoryAccordion">
                    @foreach ($categories as $index => $category)
                        <div class="accordion-item border-0 mb-3">
                            <div
                                style="min-height: 150px;"
                                class="card cursor-pointer"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $index }}"
                                style="border-radius: 12px; overflow: hidden;"
                            >
                                <img src="{{ categoryImageThumb($category->image) }}" alt=""
                                     style="width: 100%; object-fit: cover;">
                                <div class="card-body bg-light">
                                    <h5 class="card-title mb-0">
                                        {{ $category->title }} ({{ $category->front_trainings_count }})
                                    </h5>
                                </div>
                            </div>

                            <div id="collapse{{ $index }}"
                                 class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                 data-bs-parent="#categoryAccordion">
                                <div class="accordion-body pt-4 bg-light">
                                    <div class="row">
                                        @foreach ($category->frontTrainings as $subcategory)
                                            <div class="col-md-4 mb-3">
{{--                                            <a style="text-decoration: none;" href="{{ route('front.categoryTrainings', rawurlencode($subcategory->name)) }}">--}}
                                            <a style="text-decoration: none;" href="{{  route('front.singleTraining', rawurlencode($subcategory->name))  }}">
{{--                                            <a style="text-decoration: none;" href="{{ route('front.categoryTrainings', rawurlencode($category->name)) }}">--}}
                                                <div class="card h-100 shadow-sm">

{{--                                                        <img src="{{  categoryImageThumb($subcategory->image) }}"--}}
                                                        <img src="{{  trainingImageThumb($subcategory->image) }}"
                                                             class="card-img-top" style="height: 200px; object-fit: cover;">

                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <h5  class="card-title" href="{{ route('front.categoryTrainings', rawurlencode($subcategory->name)) }}">
                                                                {{ $subcategory->title }}
                                                            </h5>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $categories->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>

        <!-- projects area end -->


    </main>
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
@endsection

@endsection
