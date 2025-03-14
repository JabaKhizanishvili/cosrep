
@component('mail::message')


# წერილის ავტორი: {{ $name }}
@if(!empty($personal_number))
# პირადი ნომერი: {{ $personal_number }}
@endif

<p></p>
@if($training_name)
    <p>ტრენინგის დასახელება:  <strong>{{ $training_name }}</strong></p>
@endif
<p></p>
@if($phone)
    <p>ტელეფონის ნომერი:  <strong>{{ $phone }}</strong></p>
@endif
<p></p>
<p>ელექტრონული ფოსტა:  <strong>{{ $email }}</strong></p>
<p>ტექსტი:  <strong>{{ $text }}</strong></p>

პატივისცემით,<br>
<a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>
@endcomponent
