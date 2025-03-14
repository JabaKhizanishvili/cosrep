@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large" style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ trainingImage($appointment->training->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h3>ტესტის დეტალები</h3>
                        <br>
                        <h1>{{ $appointment->training->name }}</h1>
                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                        <span class="first-item">
                                        <a href="{{ route('front.index') }}">მთავარი</a></span>
                                <span class="separator">&gt;</span>

                                <span class="first-item">
                                    <a href="{{ route('front.dashboard') }}">{{ $page->name }}</a></span>
                                <span class="separator">&gt;</span>


                                <span class="last-item">{{ limit_words($appointment->training->name, 50) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->



        <div id="features" class="wrap-bg wrap-bg-dark services">
            <!-- .container -->
            <div class="container">
                <!-- .row start -->
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb25">
                        <!-- 1 -->
                        <div class="single-features-light"><!-- single features -->
                            <div class="move question_section">
                                <!-- uses solid style -->
                                <h4><a href="#">{{ $appointment->training->name }}</a></h4>
                                <ul>
                                    <li>ტრენინგის დაწყების დრო: {{ date('Y-m-d H:i:s', strtotime($appointment->start_date)) }}</li>
                                    <li>ტრენინგის დასრულების დრო: {{ date('Y-m-d H:i:s', strtotime($appointment->end_date)) }}</li>
                                    <li>ტესტი დაასრულეთ: {{ date('Y-m-d H:i:s', strtotime($appointmentCustomer->finished_at)) }}</li>
                                    <li>კითხვების რაოდენობა: {{ count(json_decode($appointmentCustomer->test)) }}</li>
                                    <li>გამსვლელი ქულა: {{ $appointmentCustomer->point_to_pass }}</li>
                                    <li>თქვენ მიერ აღებული ქულა: {{ $appointmentCustomer->final_point }}</li>
                                    <br>
                                    <li>
                                        ტესტის სტატუსი:
                                        @if($appointmentCustomer->passed())
                                            <span class="btn btn-success text-white">წარმატებული</span>
                                        @else
                                            <span class="btn btn-danger text-white">წარუმატებელი</span>
                                        @endif
                                    </li>
                                </ul>
                                <br>
                                {{-- <p>თქვენი პასუხი: <span class="btn btn-info text-white" style="text-transform: unset">{{ $test_answers[$customer_answer_numbers[$key]] }}</span></p>
                                <p>ქულა: <span class="btn btn-info text-white">{{ $customer_answer_numbers[$key] == $test->correct ? '1' : '0' }}</span></p> --}}
                            </div>
                        </div><!-- end single features -->
                    </div>

                    @foreach (json_decode($appointmentCustomer->test) as $key => $test)
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb25">

                            <!-- 1 -->
                            <div class="single-features-light"><!-- single features -->
                                <div class="move question_section">
                                    <!-- uses solid style -->
                                    <h4><a href="#">#{{ $key + 1 }} - {{ $test->question }}</a></h4>
                                    <ul>
                                        @php
                                        $customer_answer_numbers = json_decode($appointmentCustomer->answers);
                                        $test_answers = json_decode($test->answers);

                                        @endphp
                                        @foreach ($test_answers as $k => $answer)
                                        @if($k == $test->correct)
                                        <li class="{{ $k == $test->correct ? 'correct_answer' : ''  }}">
                                            {{ $answer }}  (სწორი პასუხი)
                                          </li>
                                        @else
                                        <li class="">
                                            {{ $answer }}
                                          </li>
                                        @endif

                                        @endforeach
                                    </ul>
                                    <br>
                                    <p>თქვენი პასუხი: <span class="btn btn-info text-white" style="text-transform: unset">{{ $test_answers[$customer_answer_numbers[$key]] }}</span></p>
                                    <p>ქულა: <span class="btn btn-info text-white">{{ $customer_answer_numbers[$key] == $test->correct ? '1' : '0' }}</span></p>
                                </div>
                            </div><!-- end single features -->
                        </div>
                    @endforeach

                </div>
                <!-- .row end -->
            </div>
            <!-- .container end -->
        </div>

                <!-- contact area start -->
                <div id="contact" class="wrap-bg">
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-lg-8">
                                <div class="section-title with-p">
                                    <h5>თუ გსურს დამატებითი კონსულტაციის ან შეხვედრის ჩანიშვნა შრომის უსაფრთხოების სპეციალისტთან მოგვწერე</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12 col-lg-12" >
                            @if(session('success'))
                                <div class="text-success" role="alert" style="text-align: center">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @php
                            $object = $appointment->training;
                            @endphp
                            <form class="themeioan-form-contact form" method="post" action="{{ route('front.sendTrainerMessage', $object) }}" style="margin: 0 auto; max-width: 700px">
                                @csrf
                                <!-- Change Placeholder and Title -->
                                <div>
                                    <input class="input-text required-field email-field" type="email" name="email"
                                        id="contactEmail" placeholder="ელ-ფოსტა" title="ელ-ფოსტა" value="{{ old('email') }}" required/>
                                    @error('email')
                                        <div class="error-msg">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <input class="input-text required-field" type="text" name="phone" id="contactPhone"
                                        placeholder="ტელეფონის ნომერი" title="ტელეფონის ნომერი" value="{{ old('phone') }}" required/>
                                    @error('phone')
                                        <div class="error-msg">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                <textarea class="input-text required-field" name="text" id="contactMessage"
                                        placeholder="ტექსტი" title="ტექსტი" required>{{ old('text') }}</textarea>
                                @error('text')
                                    <div class="error-msg">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <input class="color-two button" type="submit"
                                    value="წერილის გაგზავნა"/>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- contact area end -->

    </main>

@endsection




