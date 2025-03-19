@extends('front.layouts.app')


@section('title')

@endsection


@section('css')
<link rel="stylesheet" href="{{ front_styles('css/tab.css') }}?v=22">
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
                        <h3>ტრენინგის დაწყება</h3>
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



        <div id="accordion-container" class="wrap-bg wrap-bg-dark">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-12">
                        <div class="section-title with-p">
                            <h2>{{ $appointment->training->name }}</h2>
                            <div class="bar"></div>
                            <p style="max-width: unset">
                                {{ $appointment->training->text }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="justify-content-center text-center">

                    <i class="fas fa-exclamation-triangle" style="color: #F7ED36; font-size: 35px; margin-bottom: 20px"></i>
                    <p>

                        ქვემოთ მოცემული ტრენინგი შედგება სხვადასხვა თემებისგან, იმისათვის, რომ გაიაროთ ტრენინგი აუცილებელია დააჭიროთ ყველა თემას, სხვა შემთხვევაში ტესტირებას ვერ გაივლით.
                    </p>
                    <p>
                        აღსანიშნავია, რომ თუ გახვალთ პროგრამიდან და თავიდან შეხვალთ აუცილებელია დააჭიროთ ყველა თემას, სხვა შემთხვევაში ტესტირებას ვერ გაივლით.
                    </p>
                    <p>გისურვებთ წარმატებებს!</p>

                </div>
                <hr style="margin-bottom: 40px">

                <div class="row">
                    <div class="col-md-3 col-lg-3">
                    </div>

                    <div class="col-md-12 col-lg-12">
                        <div id="accordion">


                            {{-- //////////////////////// --}}
                            <div class="tabs-to-dropdown">
                                <div class="nav-wrapper tabHeader d-flex align-items-center justify-content-between">
                                  <ul class="nav nav-pills d-md-flex" id="pills-tab" role="tablist">
                                    @foreach ($appointment->training->media as $key => $media)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $key == 0 ? 'active bg-success text-white' : '' }} tabItem fileItem @if($key > 0)unseen @endif" data-toggle="pill" href="#tab_{{ $media->id }}" role="tab" aria-controls="pills-company" aria-selected="true" data-id='{{ $media->id }}' data-name="{{ $media->name }}">თემა {{ $key + 1 }}</a>
                                        </li>
                                    @endforeach

                                    @if(!empty($appointment->training->resources))
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link tabItem" data-toggle="pill" href="#resources" role="tab" aria-controls="pills-company" aria-selected="true">რესურსები</a>
                                        </li>
                                    @endif
                                  </ul>
                                </div>

                                @if(count($appointment->training->media) > 0)
                                <h5 class="file-title" id="file-title">{{ $appointment->training->media[0]->name }}</h5>
                                @endif

                                <div class="tab-content" id="pills-tabContent">
                                  @foreach ($appointment->training->media as $key => $media)
                                  <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }} " id="tab_{{ $media->id }}" role="tabpanel" aria-labelledby="tab_{{ $media->id }}">
                                    <div class="">
                                        <div class="">
                                            @if($media->type == \App\Models\TrainingMedia::TYPE_DOCUMENT)
                                                <embed src="{{ amazon_s3_url($media->path) }}#toolbar=0" type="application/pdf" width="100%" height="600px" />
                                            @elseif($media->type == \App\Models\TrainingMedia::TYPE_VIDEO)
                                                <video width="320" height="240" controls controlsList="nodownload">
                                                    <source src="{{ amazon_s3_url($media->path) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    </div>
                                  </div>
                                  @endforeach

                                  @if(!empty($appointment->training->resources))
                                    <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources">
                                        <div class="container-fluid" style="height: 609px; background: #fff">

                                            @foreach (json_decode($appointment->training->resources) as $ka => $resource)
                                                <p>
                                                    #{{ $ka + 1 }} -
                                                    <a style="font-size: 18px;     text-decoration: underline;
                                                    text-decoration-color: #a2dffb; color:#0089c7" target="_blank" href="{{ @$resource->url }}">{{ @$resource->name }}</a>
                                                </p>


                                            @endforeach
                                        </div>
                                    </div>
                                  @endif
                                </div>
                            </div>
                              <br>
                              <br>
                              <br>
                              <br>

                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 mt-5">
                        <div style="display: inline-block; float:right">
                            <a  target="_blank" href="{{ route('front.startTestView', $appointment) }}" class="btn btn-success text-white float-right" id="start-test">ტესტის დაწყება</a>
                            <br>
                            <p id="test-warning">ტესტის დასაწყებად გთხოვთ გაიაროთ ყველა თემა</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection



@section('js')

<script>

function disableContextMenu()
  {
    window.frames["fraDisabled"].document.oncontextmenu = function(){alert("No way!"); return false;};
    // Or use this
    // document.getElementById("fraDisabled").contentWindow.document.oncontextmenu = function(){alert("No way!"); return false;};;
  }

    document.addEventListener("contextmenu", function(e){
        e.preventDefault();
    }, false);

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
  }());


  document.addEventListener("DOMContentLoaded", function() {
      var userId = "{{ $customer->getAuthIdentifier() }}";
    var unseen = document.querySelectorAll('.unseen').length;
      var unseenElements = document.querySelectorAll('.unseen');
    var tabItem = document.querySelectorAll('tabItem');
  var startTestBtn = document.getElementById('start-test');
  var testWarning = document.getElementById('test-warning');
      // var seenItems = JSON.parse(localStorage.getItem('seenItems')) || [];

      var localStorageKey = 'seenItems_' + userId;
      var seenItems = JSON.parse(localStorage.getItem(localStorageKey)) || [];
      unseenElements.forEach(function(e) {
          let itemId = e.getAttribute('data-id'); // მივიღოთ data-id
          if (itemId && seenItems.includes(itemId)) {
              e.classList.remove('unseen');
              e.classList.add("text-white", "bg-success");
          }
      });

    if(unseen > 0){
        startTestBtn.classList.add('disabled-link')
        testWarning.style.display = 'block';
    }

      var unseenLenght = document.querySelectorAll('.unseen').length;
      if(unseenLenght  == 0){
          startTestBtn.classList.remove('disabled-link')
          testWarning.style.display = 'none';
      }

    //unset unseen
    window.addEventListener('click', function(e){
        if(e.target.classList.contains('unseen')){
            e.target.classList.remove('unseen');
            e.target.classList.add("text-white", "bg-success");
            let itemId = e.target.getAttribute('data-id');
            seenItems.push(itemId);
            // localStorage.setItem('seenItems', JSON.stringify(seenItems));
            localStorage.setItem(localStorageKey, JSON.stringify(seenItems));
        }
        var unseenLenght = document.querySelectorAll('.unseen').length;
        if(unseenLenght  == 0){
            startTestBtn.classList.remove('disabled-link')
            testWarning.style.display = 'none';
        }
    })

    var fileItem = document.querySelectorAll('.fileItem');


    window.addEventListener('click', function(e){
        if(e.target.classList.contains('fileItem')){
            let dataAttribute = e.target.getAttribute('data-name');
            document.getElementById('file-title').innerText = dataAttribute;
        }

    })


  });




</script>
<script src='{{ front_styles("js/tab.js") }}'></script>
@endsection
