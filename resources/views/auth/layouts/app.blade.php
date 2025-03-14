<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK Admin Template - Login Cover Page</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ admin_styles('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ admin_styles('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ admin_styles('assets/css/authentication/form-1.css') }}?v=3" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
</head>
<body class="form">


    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        @yield('content')
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>



    <script>

document.addEventListener('DOMContentLoaded', function(){
@if(session('success'))
    Snackbar.show({
        text: '{{session('success')}}',
        actionTextColor: '#fff',
        backgroundColor: '#8dbf42',
        pos: 'bottom-right'
    });
    @endif



    @if(session('error'))
    Snackbar.show({
        text: '{{session('error')}}',
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'bottom-right'
    });
@endif
)};

    </script>





    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ admin_styles('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ admin_styles('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ admin_styles('bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ admin_styles('assets/js/authentication/form-1.js') }}"></script>

</body>
</html>
