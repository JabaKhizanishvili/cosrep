{{--@component('mail::message')--}}
{{--@php--}}
{{--    $lang = config('meta.email_language'); // კონფიგიდან ენის ამოღება--}}

{{--@endphp--}}


@if($lang == 'ge')
     ძვირფასო {{ $name }}

    <p>ტრენინგი დაიწყება: <strong>{{ $start_date }}</strong></p>

    <ul>
        <li>ტრენინგის სახელი: <strong>{{ $training_name }}</strong></li>
        <li>ტრენინგის დასაწყებად გთხოვთ გადახვიდეთ ლინკზე: <br>
        <li>გთხოვთ გაითვალისწინოთ, რომ ტრენინგის გავლა შესაძლებელია კომპიუტერის საშუალებით. <br>
            <a href="{{ route('front.startTrainingView', [ 'locale' => $lang, 'object' => $appointment  ])}}">
                <strong>{{ route('front.startTrainingView', [ 'locale' => $lang, 'object' => $appointment  ]) }}</strong>
            </a>

            {{--            <a href="{{ route('front.startTrainingView', ['locale' => $lang, 'object' => $appointment]) }}">--}}
            {{--                <strong>{{ route('front.startTrainingView', ['locale' => $lang, 'object' => $appointment]) }}</strong>--}}
            {{--            </a>--}}

        </li>
        <li>Username: <strong>{{ $username }}</strong></li>
        @if(empty($password))
            <li>დაგავიწყდათ პაროლი?
                <a style=" text-decoration:underline" href="{{ route('forget.password.get') }}">პაროლის აღდგენა</a>
            </li>
        @else
            <li>Password: <strong>{{ $password }}</strong></li>
        @endif
    </ul>



    პატივისცემით,<br>
    <a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>
@else
     Dear {{ $name }}

    <p>The training will start on: <strong>{{ $start_date }}</strong></p>

    <ul>
        <li>Training name: <strong>{{ $training_name }}</strong></li>
        <li>To start the training, please visit: <br>
        <li>Please note that the training can be completed via computer. <br>

            <a href="{{ route('front.startTrainingView', [ 'locale' => $lang, 'object' => $appointment  ])}}">
                <strong>{{ route('front.startTrainingView', [ 'locale' => $lang, 'object' => $appointment  ]) }}</strong>
            </a>
        </li>
        <li>Username: <strong>{{ $username }}</strong></li>
        @if(empty($password))
            <li>Forgot your password?
                <a style="text-decoration:underline" href="{{ route('forget.password.get') }}">Reset Password</a>
            </li>
        @else
            <li>Password: <strong>{{ $password }}</strong></li>
        @endif
    </ul>



    Best regards,<br>
    <a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>
@endif

{{--@endcomponent--}}
