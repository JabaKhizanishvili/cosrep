@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large bg-blog-detail" style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ pageImage($page->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h1>{{ $page->name }}</h1>
                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                        <span class="first-item">
                                        <a href="{{ route('front.index') }}">მთავარი</a></span>
                                <span class="separator">&gt;</span>
                                <span class="last-item">{{ $page->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->

        <!-- blog area start -->
        <div id="blog" class="wrap-bg">
            <div class="container">
                <!-- .row -->
                <div class="row">
                    @foreach ($blogs as $blog)

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 blog-single mb20">
                            <!-- 1 -->
                            <div class="themeioan_blog">
                                <article><!-- single blog articles -->
                                    <div class="blog-photo">
                                        <a href="{{ route('front.singleBlog', urlencode($blog->name)) }}"><img src="{{ blogImage($blog->image) }}" alt="Blog"></a>
                                    </div>
                                    <div class="blog-content">
                                        <h5 class="title" style="min-height: 95px"><a href="{{ route('front.singleBlog', urlencode($blog->name)) }}">{{ limit_words($blog->name, 50) }}</a>
                                        </h5>
                                        <p>
                                            {{ limit_words(strip_tags($blog->text), 100) }}
                                        </p>
                                        <a href="{{ route('front.singleBlog', urlencode($blog->name)) }}" class="button-light"><i class="fas fa-arrow-right"></i> ვრცლად</a>
                                    </div>
                                </article><!-- end single blog articles -->
                            </div>
                        </div>

                    @endforeach

                    {{ $blogs->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
                </div>
                <!-- .row end -->


                <!-- .navigation end -->

            </div>
        </div>
        <!-- blog area end -->

    </main>

@endsection
