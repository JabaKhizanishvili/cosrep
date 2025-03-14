@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

<style>
    .section-title p{
    max-width: unset;
    }
</style>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large" style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ pageImage($page->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h1>{{ $object->name }}</h1>

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



        <div id="accordion-container" class="wrap-bg wrap-bg-dark">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-12">
                        <div class="section-title with-p">
                            <h2>{{ $object->name }}</h2>
                            <div class="bar"></div>
                            <p style="max-width: unset">
                                {!! $object->text !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection

