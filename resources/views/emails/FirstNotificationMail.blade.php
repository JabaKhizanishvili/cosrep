@component('mail::message')


# ძვირფასო {{ $name }}

<p>თქვენ წარმატებით დარეგისტრირდით ტრენინგზე  <strong>"{{ $training_name }}"</strong></p>


<a href="{{ route('front.login') }}"></a>


<ul>
    <li>ავტორიზაციის ლინკი: <strong><a href="{{ route('front.login') }}">{{ route('front.login') }}</a></strong></li>
    <li>Username: <strong>{{ $username }}</strong></li>
    <li>Password: <strong>{{ $password }}</strong></li>
    <li>ტრენინგის დასაწყებად გთხოვთ გადახვიდეთ ლინკზე: <br> <a href="{{ route('front.startTrainingView', $appointment) }}"><strong>{{ route('front.startTrainingView', $appointment) }}</strong></a></li>
</ul>

<ul>
    <li>ტრენინგის დაწყების დრო: <strong>{{ $start_date }}</strong></li>
    <li>პლატფორმაზე წვდომის ხანგრძლივობა: <strong>{{ $duration }} საათი</strong></li>
    {{-- <li>ჩემი ტრენინგები: <a href="{{ route('front.dashboard') }}"><strong>{{ route('front.dashboard') }}</strong></li> --}}

</ul>



პატივისცემით,<br>
<a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>
@endcomponent
