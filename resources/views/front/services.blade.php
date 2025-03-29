@extends('front.layouts.app')


@section('title')

@endsection


@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .mySwiper {
            width: 100vw; /* სიგანე იქნება ვიუდოუს (viewport) სიგანეზე */
            height: 60vh; /* სიმაღლე იქნება ვიუდოუს სიმაღლეზე */
            margin-left: calc(-50vw + 50%); /* ეს გაასწორებს მშობლის გასწვრივ, რომ გასცდეს */
        }

        .swiper-slide {
            width: 100%; /* ყოველი სლაიდი 100% ფართო იქნება */
            overflow: hidden;
        }

        swiper-slide img{
            object-fit: fill;
        }


        h2 {
            margin: 0;
            font-size: 2rem;
            cursor: pointer;
            color: whitesmoke;
        }

        p {
            font-size: 1rem;
            margin-top: 10px;
            cursor: pointer;
        }

        .slide-content h2 {
            min-height: 5vw;
            text-justify: inter-word;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* 3 ხაზის შეზღუდვა */
            -webkit-box-orient: vertical;
            overflow: hidden;  /* ზედმეტი ტექსტის დამალვა */
            text-overflow: ellipsis;  /* ზედმეტი ტექსტის დამალვა "..." */
            /*line-height: 1.5em;*/
        }

        .slide-content p {
            min-height: 4vw;
            text-align: justify;
            text-justify: inter-word;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* 3 ხაზის შეზღუდვა */
            -webkit-box-orient: vertical;
            overflow: hidden;  /* ზედმეტი ტექსტის დამალვა */
            text-overflow: ellipsis;  /* ზედმეტი ტექსტის დამალვა "..." */
            line-height: 1.5em; /* ხაზის სიმაღლე */
        }
        .slide-content p img {
            display: none;  /* სურათების დამალვა */
        }

        .swiper-pagination {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .swiper-pagination-bullet {
            background-color: #ffffff;
            width: 18px;
            height: 18px;
            margin: 0 5px;
            border-radius: 50%;
            transition: all 0.3s ease-in-out;
            border: 1px solid #e0e0e0; /* თეთრი ბორდერი ყველა ბულეტზე */
            opacity: 1;
        }

        .swiper-pagination-bullet:hover {
            background-color: #888; /* ჰოვერზე ოდნავ უფრო მუქი */
        }

        .swiper-pagination-bullet-active {
            background-color: #e9204f; /* აქტიური ბულეტის შიგნით ფერი */
            border: 1px solid #e0e0e0; /* თეთრი ბორდერი ისევ */
        }



        .image-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: all 0.1s ease-in-out;
            -webkit-filter: grayscale(90%);
            filter: grayscale(90%);
            -webkit-transition: .3s ease-in-out;
            transition: .3s ease-in-out;
        }

        .service-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out; /* ანიმაციის ეფექტები */

        }

        .swiper-slide:hover .service-image {
            transform: scale(1.1); /* Zooms the image */
        }

        .swiper-slide:hover .image-wrapper {
            -webkit-filter: grayscale(0);
            filter: grayscale(0);
        }


        .swiper-slide:hover .slide-content i {
            /*display: block;*/
            opacity: 1;
        }

        .swiper-slide:hover .slide-content {
            opacity: 1;
            bottom: 30px;
        }

        .slide-content {
            cursor: pointer;
            text-align: center;
            color: white; /* Default text color */
            border-radius: 10px;
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            transition: 0.3s ease-in-out;
        }

        .slide-content i {
            opacity: 0; /* დამალული */
            transition: opacity 0.3s ease-in-out;
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

                        <div class="mb-5 swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($services as $key =>$service)
                                <div class="swiper-slide">
                                    <a href="{{route('front.singleServices',urlencode($service->slug))}}">
                                    <div class="image-wrapper">
                                        <img src="{{ServicesImage($service->image)}}" alt="{{$service->name}}" class="service-image"/>
                                    </div>
                                    <div class="slide-content">
                                        <h2>{{$service->name}}</h2>
                                        <p class="mt-4 px-2">  {!! \Str::limit(strip_tags($service->text), 155) !!}  </p>
                                        <i class="bi bi-arrow-right h3"></i>
                                    </div>
                                    </a>
                                </div>
                                @endforeach

                            </div>
                        </div>
                            <div class="swiper-pagination"></div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                    </div>
                </div>
            </div>
        </div>
        <!-- accordion area end -->
    </main>


@endsection

@section('js')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,  // ნორმალური ეკრანებისთვის 3 სლაიდი
            spaceBetween: 15,   // სივრცე სლაიდებს შორის
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            fadeEffect: {
                crossFade: true,
            },
            breakpoints: {
                // 320px-დან 768px-მდე (პატარა ეკრანებისთვის)
                0: {
                    slidesPerView: 1,  // მხოლოდ ერთი სლაიდი
                },
                // 769px-დან 1024px-მდე (მეორე ზომის ეკრანებისთვის)
                768: {
                    slidesPerView: 2,  // ორი სლაიდი
                },
                // 1025px-ზე მეტი ზომა (საშუალო და დიდი ეკრანებისთვის)
                1025: {
                    slidesPerView: 3,  // სამი სლაიდი
                },
            },
        });

    </script>
@endsection
