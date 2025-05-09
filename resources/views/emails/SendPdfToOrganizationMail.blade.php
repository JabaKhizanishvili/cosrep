@component('mail::message')
@if($lang == 'ge')
# გამარჯობა, გიგზავნით სწავლების აღრიცხვის ჟურნალს


<ul>
    <li>ტრენინგის სახელი: <strong>{{ $training_name }}</strong></li>
    <li>ტრენინგის ჩატარების დრო: <strong>{{ $start_date }} / {{ $end_date }}</strong></li>
    <li>ორგანიზაცია: <strong>{{ $organization->name }}</strong></li>
    <li>ოფისი: <strong>{{ $office->name }}</strong></li>
</ul>

პატივისცემით,<br>
<a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>

@else

# Hello,We are sending you the training record book.

<ul>
    <li>Training Name: <strong>{{ $training_name }}</strong></li>
    <li>Training Date: <strong>{{ $start_date }} / {{ $end_date }}</strong></li>
    <li>Organization: <strong>{{ $organization->name }}</strong></li>
    <li>Office: <strong>{{ $office->name }}</strong></li>
</ul>

Best regards,<br>
<a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>

@endif
@endcomponent
