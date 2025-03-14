@component('mail::message')


# ძვირფასო {{ $name }}

<p>ტრენინგი დაიწყება: <strong>{{ $start_date }}</strong> </p>


<ul>
    <li>ტრენინგის სახელი: <strong>{{ $training_name }}</strong></li>
    <li>ტრენინგის დასაწყებად გთხოვთ გადახვიდეთ ლინკზე: <br> <a href="{{ route('front.startTrainingView', $appointment) }}"><strong>{{ route('front.startTrainingView', $appointment) }}</strong></a></li>
    <li>Username: <strong>{{ $username }}</strong></li>
</ul>

<ul>
    <li>პლატფორმაზე წვდომის ხანგრძლივობა: <strong>{{ $duration }} საათი</strong></li>
    {{-- <li>ჩემი ტრენინგები: <a href="{{ route('front.dashboard') }}"><strong>{{ route('front.dashboard') }}</strong></li> --}}
</ul>



პატივისცემით,<br>
<a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>
@endcomponent
