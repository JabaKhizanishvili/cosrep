@component('mail::message')


# გამარჯობა, გიგზავნით სწავლების აღრიცხვის ჟურნალს


<ul>
    <li>ტრენინგის სახელი: <strong>{{ $training_name }}</strong></li>
    <li>ტრენინგის ჩატარების დრო: <strong>{{ $start_date }} / {{ $end_date }}</strong></li>
    <li>ორგანიზაცია: <strong>{{ $organization->name }}</strong></li>
    <li>ოფისი: <strong>{{ $office->name }}</strong></li>
</ul>

პატივისცემით,<br>
<a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>
@endcomponent
