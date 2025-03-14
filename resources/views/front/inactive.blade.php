@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

<main>
    <!-- breadcrumb banner content area start -->
    <div class="lernen_banner large bg-about">
        <div class="container">

        </div>
    </div>
    <!-- end breadcrumb banner content area start -->

    <!-- members area start -->
    <div id="members" class="wrap-bg wrap-bg-dark">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="section-title with-p">
                        {!! $content !!}

                        <p>დამატებითი ინფორმაციისთვის <a style="font-weight: 800" href="{{ route('front.contact') }}">გთხოვთ დაგვიკავშირდით</a> </p>
                    </div>
                    <div class="mt-25 mb-50">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- members area end -->
</main>

@endsection
