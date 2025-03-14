@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <div id="countDown-section">
        <div id="countdownHeadline">დასრულებამდე დარჩა:</div>

        <div id="countdown">
          <ul>
            <li><span id="hours"></span>საათი</li>
            <li><span id="minutes"></span>წუთი</li>
            <li><span id="seconds"></span>წამი</li>
          </ul>
        </div>
    </div>

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large" style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ trainingImage($appointment->training->image) }});">
            <div class="container">
                <div class="row">

                    <div class="lernen_banner_title">
                        <h3>ტესტის დაწყება</h3>
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



            <form action="{{ route('front.EndTest', $appointment) }}" id="endTestForm" method="POST">
                @csrf
            <!-- .container -->
            <div class="container">
                <!-- .row start -->
                <div class="row">
                    @if(session('error'))
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb25">
                            <div class="alert alert-danger" role="alert">
                                {{session('error')}}
                            </div>
                        </div>
                    @endif

                    @foreach ($appointment->training->tests as $key => $test)
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb25 parent_div" id="scrollable_{{ $key }}">

                            <!-- 1 -->
                            <div class="single-features-light"><!-- single features -->
                                <div class="move question_section">
                                    <!-- uses solid style -->
                                    <h4><a href="#">#{{ $key + 1 }} - {{ $test->question }}</a></h4>
                                    <ul>
                                        @foreach (json_decode($test->answers) as $k => $answer)
                                        <li>
                                            <input type="radio"  name="answer_{{ $test->id }}" class="answers"  value="{{ $k }}" {{ old("answer_$test->id") == $k && old("answer_$test->id") != null ? 'checked' : '' }}> {{ $answer }}
                                        </li>
                                        @endforeach
                                    </ul>

                                    <div class="questionError">სავარაუდო პასუხის არჩევა სავალდებულოა</div>
                                </div>
                            </div><!-- end single features -->
                        </div>
                    @endforeach

                </div>
                <!-- .row end -->

                <div class="row">
                    <div class="col-md-12 col-lg-12 mt-5">
                        <button class="btn btn-success text-white float-right" >ტესტის დასრულება</button>

                    </div>
                </div>
            </div>
        </form>
            <!-- .container end -->
        </div>

    </main>

@endsection

@section('js')
<script>
    (function () {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;


  const ddd = "{{ $appointment->end_date }}"
  const countDown = new Date(ddd).getTime(),
      x = setInterval(function() {

        const now = new Date().getTime(),
              distance = countDown - now;

          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance < 0) {
          document.getElementById("countdownHeadline").innerText = "დრო ამიწურა!";
          document.getElementById("countdown").style.display = "none";
          clearInterval(x);
        }
        //seconds
      }, 0)

      //check if all questions are answered



        $( "#endTestForm" ).submit(function( event ) {

            var question_length =  $('.question_section').length;
            var answered_length = 0;
            var scrolled = false;

            $('.question_section').each(function(i,obj){
                all_answered = false;
                var answers = $(obj).find('.answers');
                var input_checked = false;
                answers.each(function(num, input_radio){
                    if($(input_radio).is(':checked')){
                        input_checked = true;
                    }
                });

                if(!input_checked){
                    $('.questionError').eq(i).css('display', 'block')
                    if(!scrolled){
                        $('html, body').animate({
                        scrollTop:   $(obj).offset().top - 200
                    }, 2000);
                    scrolled = true;
                    }





                }else{
                    $('.questionError').eq(i).css('display', 'none')
                    answered_length++;
                }
            })

            if(answered_length == question_length){
                    return true;
                }else{
                    return false;

                }

        });


  }());
</script>

@endsection


