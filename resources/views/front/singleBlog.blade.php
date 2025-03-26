@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

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
                        <h1>{{ $blog->name }}</h1>
                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                <span class="first-item">
                                <a href="{{ route('front.index') }}">{{__('page.main')}}</a></span>
                                <span class="separator">&gt;</span>

                                <span class="first-item">
                            <a href="{{ route('front.blogs') }}">{{ $page->name }}</a></span>
                                <span class="separator">&gt;</span>


                                <span class="last-item">{{ limit_words($blog->name, 50) }}</span>
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
                    <div class="col-md-12 col-lg-8">
                        <div class="blog-content">
                            <div class="blog-detail-img">
                                <img src="{{ blogImage($blog->image) }}" alt="{{ $blog->name }}"/>
                            </div>
                            <div class="section-title">
                                <div>
                                    <h3>{{ $blog->name }}</h3>
                                </div>
                                <div class="course-viewer">
                                    <ul>
                                        <li>
                                            <i class="fas fa-calendar-alt"></i>{{ date('Y-m-d H:i', strtotime($blog->created_at)) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <p>
                                {!! $blog->text !!}
                            </p>


                        </div>
                    </div>


                    <!-- Sidebar Right -->
                    <div class="col-md-12 col-lg-4">
                        <div class="detail-widgets widget_thumb_post">
                            <h4 class="title">Latest News</h4>
                            <ul>
                                @foreach ($blogs as $blog_)
                                    <li>
                                    <span class="left">
                                    <img src="{{ blogImage($blog_->image) }}" alt="" class="">
                                    </span>
                                        <span class="col-right">
                                    <a class="feed-title"
                                       href="{{ route('front.singleBlog', urlencode($blog_->name)) }}">{{ $blog_->name }}</a>
                                    <span class="post-date"><i class="fas fa-calendar-alt"></i>{{ date('Y-m-d H:i', strtotime($blog_->created_at)) }}</span>
                                    </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Detail area end -->
    </main>

@endsection
