@extends('front.layouts.app')


@section('title')

@endsection


@section('css')
    <style>
        .themeioan_counter i {
            color: #fff;
        }
    </style>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <style>
        .sliderSize {
            background-size: 100% 100% !important;


        }
    </style>

    <main>

        @if(count($sliders) > 0)
            <!-- Slider Start -->
            <div class="relative" style="min-height: 100vh">
                <div class="owl-navigation owl-carousel owl-theme">
                    <!-- slider item 1 -->
                    @foreach ($sliders as $slider)
                        <div class="item">
                            <div class="image-overly-dark-opacity header-content sliderSize" role="banner"
                                 style="background: url({{ sliderImage($slider->image) }}) no-repeat;">
                                <div class="container opac">
                                    <div class="col-xs-12 col-sm-12 header-area">
                                        <div class="header-area-inner header-text"> <!-- single content header -->
                                            <div><span class="subtitle">{{ $slider->name }}</span></div>
                                            <div class="btn-section">
                                                @if($slider->url)
                                                    <a href="{{ $slider->url }}" target="_blank"
                                                       class="color-two btn-custom">{{__('page.see_more')}}<i
                                                            class="fas fa-arrow-right"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end slider item 1 -->
                    @endforeach
                </div>
            </div>
            <!-- Slider End-->
        @else
            <div style="padding-top: 200px"></div>
        @endif


        @if($section_two)
            <!-- why-us area start -->
            <div id="why-us" class="wrap-bg-second">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-5 services-detail-why why-us-left-bg2"
                         style="background-image: url({{ sectionImage($section_two->image) }});
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-xl-6 col-lg-7 wrap-padding text-left">
                        <div class="section-title">
                            <div>
                                <h3>{{ $section_two->title }}</h3>
                                <div class="bar"></div>
                            </div>
                            <p>
                                {!! $section_two->text !!}
                            </p>
                            <div class="row">
                                <!-- #counter -->


                                @if(!empty($section_two->stats))
                                    @php
                                        $statsData = $section_two->stats;

                                        if (is_string($statsData)) {
                                            $statsData = json_decode($statsData, true); // true - ასოციატიური მასივისთვის
                                        }

                                        if (is_array($statsData) && isset($statsData[app()->getLocale()])) {
                                            $localeData = $statsData[app()->getLocale()];
                                            $statsArray = is_string($localeData) ? json_decode($localeData, true) : $localeData;
                                        } elseif (is_array($statsData) && isset($statsData['ge'])) {
                                            $localeData = $statsData['ge'];
                                            $statsArray = is_string($localeData) ? json_decode($localeData, true) : $localeData;
                                        } else {
                                            $statsArray = $statsData;
                                        }

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

                                <!-- .row end -->
                                <!-- #counter area end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(count($partners) > 0)
            <!-- services image area start -->
            <div id="services_image" class="wrap-bg wrap-bg-light">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">
                            <div class="section-title with-p">
                                <h2>{{__('page.our_partners')}}</h2>
                                <div class="bar"></div>
                                {{-- <p>We can help you create positive and permanent changes in your life. Let’s Create Something new and awesome Togeather. --}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </div>

                    <!-- .row -->
                    <div class="row">

                        @foreach ($partners as $partner)

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 course-single mb25">
                                <!-- 1 -->
                                <div class="themeioan_services">
                                    <article><!-- single services -->
                                        <div class="blog-content">
                                            <div class="icon-space">
                                                <img src="{{ partnerImage($partner->image) }}" alt=""
                                                     style="width: 100%; height:200px; object-fit:contain">
                                                {{-- <div class="glyph-icon flaticon-030-test"></div> --}}
                                            </div>
                                            <h5 class="title"><a>{{ $partner->name }}</a>
                                            </h5>
                                            {{-- <p>Open a beautiful store & increase your conversion rates. Deploy a conversion rate optimization. Best Services. --}}
                                            </p>
                                            <div class="mt-25">
                                                @if($partner->url)
                                                    <a href="{{ $partner->url }}" target="_blank"
                                                       class="button-light"><i
                                                            class="fas fa-arrow-right"></i> {{__('page.see')}}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </article><!-- end single services -->
                                </div>
                            </div>

                        @endforeach

                    </div>

                    {{-- <div class="content-button btn-section"><!-- button call to action -->
                        <a href="services.html" class="color-two btn-custom ">View All Services <i class="fas fa-arrow-right"></i></a>
                    </div> --}}

                    <!-- .row end -->
                </div>
            </div>
        @endif
        <!-- services image area end -->



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
                                            <h3>{{ $section_one->title }}</h3>
                                            <div class="bar"></div>
                                        </div>
                                    </div>
                                    {!! $section_one->text !!}
                                    @if(!empty($section_one->stats))
                                        <ul class="themeioan_ul_icon">
                                            @php
                                                $section_one_stats = $section_one->getTranslation('stats', app()->getLocale());
                                            @endphp
                                            @if(is_array($section_one_stats))
                                                @foreach ($section_one_stats as $section_one_stat)
                                                    <li><i class="fas fa-check-circle"></i> {{ $section_one_stat }}</li>
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
        <!-- why-us area end -->

        <!-- why-us area end -->
    </main>

@endsection
