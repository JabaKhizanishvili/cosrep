@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <style>
        .textmakeblack p{
            color: black !important;
        }
    </style>
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
                                <span class="last-item">{{ $page->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->

        <!-- features area start -->

        <!-- features area end -->
        <!-- services area start -->
        <div id="services" class="wrap-bg">
            <!-- .container -->
            <div class="container">
                <div class="row">
{{--                    <div class="col-md-6">--}}
{{--                        <div class="dreidbgleft">--}}
{{--                            <img src="{{ aboutImage($about->image) }}" alt="Buy this Course">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-md-12">
                        <div class="img" style="text-align: center">
                            <img src="{{ aboutImage($about->image) }}" alt="Buy this Course">
                        </div>
                        <div class=""  style="margin-top: 5vh">
                            <div>
                                <h3 style="text-align: center">{{ $about->title }}</h3>
                                <div class="bar"></div>
                                <span class="textmakeblack" style="color: black">
                                    {!! $about->text !!}
                                </span>

                                <div class="row black-text">

                                    {{--                                    @if(!empty($about->stats))--}}

                                    {{--                                        @php--}}
                                    {{--                                            $about_stats = json_decode($about->stats);--}}
                                    {{--                                        @endphp--}}
                                    {{--                                        @if(is_array($about_stats))--}}
                                    {{--                                            @foreach ($about_stats as $stat)--}}
                                    {{--                                                <div class="col-xs-12 col-sm-12 col-md-4">--}}
                                    {{--                                                    <div class="info">--}}
                                    {{--                                                        <!-- 1 -->--}}
                                    {{--                                                        <div class="themeioan_counter text-center">--}}
                                    {{--                                                            <!-- single counter item -->--}}
                                    {{--                                                            <i class="secondary-color fas {{ $stat->stat_icon }} fa-3x"></i>--}}
                                    {{--                                                            <h4>{{ $stat->stat_number }}</h4>--}}
                                    {{--                                                            <p>{{ $stat->stat_name }}</p>--}}
                                    {{--                                                        </div><!-- end single counter item -->--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        @endif--}}
                                    {{--                                    @endif--}}

                                    @if(!empty($about->stats))
                                        @php
                                            // 1. მონაცემების მომზადება
                                            $statsData = $about->stats;

                                            // 2. თუ JSON სტრინგია, დეკოდირება
                                            if (is_string($statsData)) {
                                                $statsData = json_decode($statsData, true); // true - ასოციატიური მასივისთვის
                                            }

                                            // 3. თუ მასივია მაგრამ აქვს ენის ქეები (Spatie translatable)
                                            if (is_array($statsData) && isset($statsData[app()->getLocale()])) {
                                                $localeData = $statsData[app()->getLocale()];
                                                $statsArray = is_string($localeData) ? json_decode($localeData, true) : $localeData;
                                            } elseif (is_array($statsData) && isset($statsData['ge'])) {
                                                // Fallback ქართულ ენაზე
                                                $localeData = $statsData['ge'];
                                                $statsArray = is_string($localeData) ? json_decode($localeData, true) : $localeData;
                                            } else {
                                                // პირდაპირი მასივი
                                                $statsArray = $statsData;
                                            }

                                            // 4. დარწმუნდით, რომ მასივია და არა ცარიელი
                                            $statsArray = is_array($statsArray) ? $statsArray : [];
                                        @endphp

                                        @if(!empty($statsArray))
                                            @foreach ($statsArray as $stat)
                                                <div class="col-xs-12 col-sm-12 col-md-4">
                                                    <div class="info">
                                                        <div class="themeioan_counter text-center">
                                                            <!-- შეამოწმეთ მასივის სტრუქტურა -->
                                                            <i class="secondary-color fas {{ $stat['stat_icon'] ?? 'fa-question' }} fa-3x"></i>
                                                            <h4>{{ $stat['stat_number'] ?? '0' }}</h4>
                                                            <p>{{ $stat['stat_name'] ?? 'No Data' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                    <!-- #counter area end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- services area end -->


        @if($section_one)
            <!-- why-us area start -->
            <div id="why-us-white">
                <div class="why-us-container why-us-left-bg5" style="background-image: url({{ sectionImage($section_one->image) }});
                background-position: right;
                background-repeat: no-repeat;
                background-size: cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-5 col-xl-6 col-lg-6">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-7 col-xl-6 col-lg-6 text-left">
                                <div class="white-box-large">
                                    <div class="section-title">
                                        <div>
                                            <h3 style="color: black">{{ $section_one->title }}</h3>
                                            <div class="bar"></div>
                                        </div>
                                    </div>
                                     <span style="color: black">{!! $section_one->text !!}</span>
                                    @if(!empty($section_one->stats))
                                        <ul class="themeioan_ul_icon">
                                            @php
                                                $section_one_stats = $section_one->getTranslation('stats', app()->getLocale());
                                            @endphp
                                            @if(is_array($section_one_stats))
                                                @foreach ($section_one_stats as $section_one_stat)
                                                    <li style="color: black"><i class="fas fa-check-circle"></i> {{ $section_one_stat }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endif
                                    @if($section_one->url)
                                        <div class="mt-25 mb-50">

                                            <a href="{{ $section_one->url }}" target="_blank"
                                               class="color-two btn-custom ">{{__('page.allservice')}} <i
                                                    class="fas fa-arrow-right"></i></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <!-- members area start -->
        {{-- <div id="members" class="wrap-bg wrap-bg-dark">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="section-title with-p">
                            <h2>ჩვენი გუნდი</h2>
                            <div class="bar"></div>
                        </div>
                    </div>
                </div>
                <div class="row carousel-slider gallery-slider">

                    @foreach ($trainers as $trainer)

                        <div class="col-lg-3">
                            <article class="item"><!-- single teacher -->
                                <a href="{{ trainerImage($trainer->image) }}" class="fancybox"
                                data-fancybox-group="images_gallery"><img src="{{ trainerImage($trainer->image) }}" alt="{{ $trainer->name }}"/></a>
                                <div class="teacher-content">
                                    <div class="teacher-social">
                                        <i class="teacher-icon fa fa-share-alt social-first"></i>
                                        @if($trainer->facebook)
                                            <a href="{{ $trainer->facebook }}" target="_blank" class="teacher-icon social-link">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        @endif

                                        @if($trainer->twitter)
                                            <a href="{{ $trainer->twitter }}" target="_blank" class="teacher-icon social-link">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        @endif

                                        @if($trainer->linkedin)
                                            <a href="{{ $trainer->linkedin }}" target="_blank" class="teacher-icon social-link">
                                                <i class="fab fa-linkedin"></i>
                                            </a>
                                        @endif

                                        @if($trainer->instagram)
                                            <a href="{{ $trainer->instagram }}" target="_blank" class="teacher-icon social-link">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        @endif

                                    </div>
                                </div>
                                <h5 style="min-height: 80px; ">{{ $trainer->name }}</h5>
                            </article><!-- end single teacher -->
                        </div>

                    @endforeach

                </div>
            </div>
        </div> --}}
        <!-- members area end -->
    </main>

@endsection
