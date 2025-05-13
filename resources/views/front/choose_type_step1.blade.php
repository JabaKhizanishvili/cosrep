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

                <div class="container my-1">
                    <h2 class="text-center mb-5">{{ $training->title }}</h2>


                    <div id="contact" class="wrap-bg">
                    <div class="row justify-content-center">
                        <div class="col-md-6 rounded shadow card">

                            <form action="{{ route('front.submitPhysicalTraining') }}" method="POST" class="p-4">
                                @csrf
                                <input type="hidden" name="training_id" value="{{ $training->id }}">

                                <div class="mb-3">
                                    <label for="phone" class="form-label">ტელეფონის ნომერი</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="მაგ: 599123456" required>
                                </div>

                                <div class="mb-4">
                                    <label for="personal_number" class="form-label">პირადი ნომერი</label>
                                    <input type="text" name="personal_number" id="personal_number" class="form-control" placeholder="მაგ: 01001012345" required>
                                </div>

                                <div class="d-grid">
                                    <input class="color-two button mb-4 w-50" style="font-size: 12px" type="submit"--}}
                                                                       value="{{__('page.next')}}"/>
                                </div>

                                @if(session('error'))
                                    <p class="text-danger">{{ session('error') }}</p>
                                @endif
                            </form>

                        </div>
                    </div>
                    </div>



                </div>


                <!-- .navigation start -->
{{--                {{ $trainings->appends($_GET)->links('vendor.pagination.bootstrap-4') }}--}}
            </div>
        </div>
        <!-- services image area end -->
    </main>

@endsection
