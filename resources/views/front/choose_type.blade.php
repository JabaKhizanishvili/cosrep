@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <style>
        .selectable-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border-width: 2px;
        }

        /* არჩევისას card-ზე ეფექტი */
        input[type="radio"]:checked + .card {
            border-color: #030277 !important;
            /*background-color: #28a745;*/
            /*color: white;*/
            box-shadow: 0 0 10px rgba(3, 2, 119, 0.5);
            /*box-shadow: 0 0 10px #030277;*/
        }

        /* მონიშნულზე შიდა ტექსტის ფერის კონტროლი */
        input[type="radio"]:checked + .card .card-title,
        input[type="radio"]:checked + .card .card-text {
            /*color: white;*/
        }

        input[type="radio"]:focus + .card {
            outline: none;
        }
    </style>
@endsection

@section('content')

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large bg-services"
             style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ categoryImage($category->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h1>{{ $category->title }}</h1>

                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                        <span class="first-item">
                                        <a href="{{ route('front.index') }}">{{__('page.main')}}</a></span>
                                <span class="separator">&gt;</span>
                                <span class="first-item">
                                    <a href="{{ route('front.trainings') }}">{{ $page->name }}</a></span>
                                <span class="separator">&gt;</span>

                                <span class="last-item">{{ limit_words($category->title, 50) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->

        <!-- services image area start -->
        <div id="services_image" class="wrap-bg">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <div class="section-title with-p">
                            <h2>{{ $page->name }}</h2>
                            <div class="bar"></div>
                            {{-- <p>Let’s Create Something new and awesome Togeather. We can help you create positive and permanent changes in your life today. --}}
                            </p>
                        </div>
                    </div>
                </div>

{{--                <h2>{{ $training->title }} - ტიპის არჩევა</h2>--}}

{{--                <form method="POST" action="{{ route('training.purchase.submit', $training->id) }}">--}}
{{--                    @csrf--}}
{{--                    <label>--}}
{{--                        <input type="radio" name="type" value="offline" required>--}}
{{--                        ფიზიკური ტრენინგი--}}
{{--                    </label>--}}
{{--                    <br>--}}
{{--                    <label>--}}
{{--                        <input type="radio" name="type" value="online" required>--}}
{{--                        ონლაინ ტრენინგი--}}
{{--                    </label>--}}
{{--                    <br><br>--}}
{{--                    <button type="submit" class="btn btn-success">გაგრძელება</button>--}}
{{--                </form>--}}

                <div class="container my-1">
                    <h2 class="text-center mb-5">{{ $training->title }} - ტიპის არჩევა</h2>

                    <form method="POST" class="" action="{{ route('training.purchase.submit', $training->id) }}">
                        @csrf

                        <div class="row justify-content-center">
                            <!-- Offline Option -->
                            <div class="col-md-5 mb-3">
                                <label class="w-100">
                                    <input type="radio" name="type" value="offline" required hidden>
                                    <div class="card border-primary h-100 selectable-card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">📍 {{__('page.training_type1')}}</h5>
                                            <p class="card-text">{{__('page.training_type1_text')}}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Online Option -->
                            <div class="col-md-5 mb-3">
                                <label class="w-100">
                                    <input type="radio" name="type" value="online" required hidden>
                                    <div class="card border-success h-100 selectable-card">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">💻 {{__('page.training_type2')}}</h5>
                                            <p class="card-text"> {{__('page.training_type2_text')}}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

{{--                        <div class="text-center mt-4">--}}
{{--                            <button type="submit" class="btn btn-success px-5">გაგრძელება</button>--}}
{{--                        </div>--}}
                        <div class="container text-center">
{{--                          <input type="hidden" name="training_id" value="{{$training->id}}">--}}
                        <input class="color-two button mb-4 w-50" style="font-size: 12px" type="submit"
                               value="{{__('page.next')}}"/>
                        </div>
                    </form>
                </div>


                <!-- .navigation start -->
{{--                {{ $trainings->appends($_GET)->links('vendor.pagination.bootstrap-4') }}--}}
            </div>
        </div>
        <!-- services image area end -->
    </main>

@endsection
