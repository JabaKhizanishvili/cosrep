<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metas Basic -->
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="description" content="Karka - Education Services School Template"/>
    <meta name="keywords" content="Landing Page, Services, Learning"/>
    <meta name="author" content="Ioan Drozd"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Title -->
    <title>{{ @$page->name }} - CONCEPT OF SAFETY</title>
    <title>
        {{ config('app.name') }}

    @yield('title')
    </title>
    <!-- Favicon -->

    <link rel="apple-touch-icon" sizes="180x180" href="{{ front_styles('favicon/apple-touch-icon.png') }}?v=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ front_styles('favicon/favicon-32x32.png') }}?v=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ front_styles('favicon/favicon-16x16.png') }}?v=1">
    <link rel="manifest" href="{{ front_styles('favicon/site.webmanifest') }}?v=1">
    <link rel="mask-icon" href="{{ front_styles('favicon/safari-pinned-tab.svg') }}?v=1" color="#5bbad5">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    {{-- <link rel="shortcut icon" href="{{ front_styles('images/favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ front_styles('css/bootstrap.min.css') }}">
    <!-- owl carousel theme default CSS file -->
    <link rel="stylesheet" href="{{ front_styles('css/owl.theme.default.min.css') }}">
    <!-- owl carousel CSS file -->
    <link rel="stylesheet" href="{{ front_styles('css/owl.carousel.min.css') }}">
    <!-- Main Custom CSS -->
    <link rel="stylesheet" href="{{ front_styles('css/main.css') }}">
    <!-- Slick  -->
    <link rel="stylesheet" href="{{ front_styles('css/slick.css') }}">
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="{{ front_styles('css/fontawesome.min.css') }}">
    <!-- jQuery Fancybox  -->
    <link rel="stylesheet" href="{{ front_styles('css/jquery.fancybox.css') }}">
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{ front_styles('css/magnific-popup.css') }}"> --}}

    <link rel="stylesheet" href="{{ front_styles('css/style.min.css') }}?v=7">

	<style>
      #footer i::before{
       color: #fff !important;
      }

      .f-widget-title h4:before{
           background-color: #fff !important;
      }
  	</style>

    @yield('css')
</head>
<body>

        <div class="dashboardMenu {{ $page->slug == '/dashboard' ? 'dashboardMenuActive' : '' }}">
            <a href="{{ route('front.dashboard') }}">
                <i class="fas fa-home" aria-hidden="true"></i>

            </a>
        </div>

<!-- header area start -->
<header id="header" class="sticky transparent-header">
    <div class="topheader top_header_light hidemobile">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                      @if($contact->phone)
                        <div class="address-icon">დაგვიკავშირდით: <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></div> </div>
                      @endif
                <div class="col-lg-5 text-right">
                    <div class="custom-page-top">
                        @if(auth()->guard(\App\Services\AuthType::TYPE_CUSTOMER)->check())
                        <a>მოგესალმებით, {{ auth()->guard(\App\Services\AuthType::TYPE_CUSTOMER)->user()->name }}</a>
                        {{-- <a href="{{ route('front.dashboard') }}" class="{{ $page->slug == '/dashboard' ? 'active' : '' }}">დეშბორდი</a> --}}
                        <form action="{{ route('front.logout') }}" method="POST" style="display: inline-block">
                            @csrf
                            <button class="unsetStyles" style="color: #fff">გასვლა</button>
                        </form>
                        @else
                        <a style="color: #fff" href="{{ route('front.loginView') }}" class="{{ $page->slug == '/login' ? 'active' : '' }}">ავტორიზაცია</a>
                        @endif
                    </div>

                    <div class="social_top_header">
                        @if($contact->facebook)
                            <a href="{{ $contact->facebook }}" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                        @endif

                        @if($contact->linkedin)
                            <a href="{{ $contact->linkedin }}" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                        @endif

                        @if($contact->youtube)
                            <a href="{{ $contact->youtube }}" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #navigation start -->
    <nav class="navbar navbar-default navbar-expand-md navbar-light" id="navigation" data-offset-top="1">
        <!-- .container -->
        <div class="container">
            <!-- Logo and Menu -->
            <div class="navbar-header">
                <div class="navbar-brand"><a href="{{ route('front.index') }}"><img src="{{ front_styles('images/logo.png') }}?v=4" alt="Logo"/></a></div>
                <!-- site logo -->
            </div>
            <!-- Menu Toogle -->
                <div class="burger-icon">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            <div class="collapse navbar-collapse " id="navbarCollapse">
                <ul class="nav navbar-nav ml-auto">

                    @foreach ($pages as $p)
                        <?php $slug  = Request::segment(1); if (strpos($slug, 'training') !== false){ $slug = 'trainings'; }; ?>

                        <li><a href="{{ $p->slug }}" class="{{ $p->slug == '/'.$slug ? 'active' : '' }}">{{ $p->name }}</a></li>
                    @endforeach
                </ul>
                @if($contact->website)

                @endif

                @if(auth()->guard(\App\Services\AuthType::TYPE_CUSTOMER)->check())
                <div class="header-cta">
                    <a href="{{ route('front.dashboard') }}" class="btn btn-1c {{ $page->slug == '/dashboard' ? 'btn-1c-active' : '' }}">ჩემი ტრენინგები</a>
                </div>
            @endif
            </div>
            <!-- Menu Toogle end -->
        </div>
        <!-- .container end -->
    </nav>
    <!-- #navigation end -->
</header>
<!-- end header area -->

@yield('content')

<!-- #footer area start -->
<footer id="footer">
    <div class="footer-top">
        <!-- .container -->
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6"><!-- footer widget -->
                    <div class="f-widget-title">
                        <h4>COS</h4>
                    </div>
                    @if($contact->address)
                        <div class="sigle-address">
                            <div class="address-icon">
                                <i class="fas fa-home"></i>
                            </div>
                                <p>{{ $contact->address }}</p>
                        </div>
                    @endif

                    @if($contact->email)
                        <div class="sigle-address">
                            <div class="address-icon">
                                <i class="far fa-envelope-open"></i>
                            </div>
                            <p>{{ $contact->email }}</p>
                        </div>
                    @endif

                    @if($contact->phone)
                        <div class="sigle-address">
                            <div class="address-icon">
                                <i class="fas fa-headphones"></i>
                            </div>
                            <p>{{ $contact->phone }}</p>
                        </div>
                    @endif
                </div><!-- footer widget -->
                <div class="col-xl-3 offset-xl-1 col-lg-2 col-sm-6"><!-- footer widget -->
                    <div class="f-widget-title">
                        <h4>მენიუ</h4>
                    </div>
                    <div class="f-widget-link">
                        <ul>
                            @foreach ($pages as $page)
                                <li><a href="{{ $page->slug }}">{{ $page->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- footer widget -->
                <div class="col-xl-3 offset-xl-1 col-lg-3 col-sm-6"><!-- footer widget -->
                    <div class="f-widget-title">
                        <h4>უსაფრთხოების პოლიტიკა</h4>
                    </div>
                    <div class="f-widget-link">
                        <ul>
                            @foreach ($policies as $policy)
                            <li><a href="{{ $policy->slug }}">{{ $policy->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div><!-- footer widget -->
            </div>
            <!-- to top -->
            <div class="cd-top"><i class="fas fa-level-up-alt"></i></div>
        </div>
    </div>
    <!-- .container end -->

    <!-- #footer bottom start -->
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="copyright">
                    <p>
                        © 2022   COS  -   All rights reserved
                    </p>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="text-right icon-round-white footer-social mt-25 mb-25">
                    @if($contact->facebook)
                        <a href="{{ $contact->facebook }}" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                    @endif

                    @if($contact->linkedin)
                        <a href="{{ $contact->linkedin }}" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                    @endif

                    @if($contact->youtube)
                        <a href="{{ $contact->youtube }}" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <!-- to top -->
        <div class="cd-top">Top</div>
        <div class="cursor"></div>
        <div class="cursor2"></div>
    </div>
    <!-- #footer bottom end -->
</footer>

    {{-- cookie Popup --}}
    <div class="col-md-4 col-sm-12 button-fixed">
        <div class="p-3 pb-4 bg-custom text-white">
          <div class="row">
            <div class="col-10">
              <h2>{{ $cookie->name }}</h2>
            </div>
            <div class="col-2 text-center">
            </div>
          </div>
          <p>{{ $cookie->text }}
          </p>
          <button type="button" class="btn w-100 accept-cookies">ვეთანხმები</button>
        </div>
      </div>
<!-- #footer area end -->

    <!-- JavaScript File -->
    <!-- jQuery -->
    {{-- <script src='{{ front_styles("js/jquery-3.4.1.min.js") }}'></script>
    <!-- Main -->
    <script src='{{ front_styles("js/main.js") }}'></script>
    <!-- Bootstrap -->
    <script src='{{ front_styles("js/bootstrap.min.js") }}'></script>
    <!-- Slick -->
    <script src='{{ front_styles("js/slick.min.js") }}'></script>
    <!-- Fancybox -->
    <script src='{{ front_styles("js/jquery.fancybox.pack.js") }}'></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{ front_styles("js/jquery.magnific-popup.min.js") }}"></script>
    <!-- Waypoints -->
    <script src='{{ front_styles("js/waypoints.min.js") }}'></script>
    <!-- Counterup -->
    <script src='{{ front_styles("js/jquery.counterup.min.js") }}'></script>
    <!-- owl carousel -->
    <script src='{{ front_styles("js/owl.carousel.min.js") }}'></script>
    <!-- Typed Animation Library -->
    <script src="{{ front_styles("js/typed.min.js") }}"></script>
    <!-- Cursor Library -->
    <script src="{{ front_styles("js/cursor.js") }}"></script> --}}

    <script src="{{ front_styles("js/js.min.js") }}"></script>


    @yield('js')

    <script>

        // cookie policy
        $(document).ready(function(){
        if (document.cookie.indexOf("accepted_cookies=") < 0) {
            $('.button-fixed').css('display', 'block');
        }

        $('.accept-cookies').on('click', function() {
            document.cookie = "accepted_cookies=yes;";
            $('.button-fixed').css('display', 'none');
        })

        })
    </script>
</body>
</html>
