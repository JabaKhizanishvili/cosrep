<h1>Forget Password Email</h1>

You can reset password from bellow link:
<a href="{{ route('reset.password.get', $token) }}">Reset Password</a>


@component('mail::message')


<p>პაროლის აღსადგენათ გთხოვთ გადახვიდეთ ლინკზე: <br> <a href="{{ route('reset.password.get', $token) }}"><strong>{{ route('reset.password.get', $token) }}</strong></a></p>

პატივისცემით,<br>
<a href="{{ config('meta.front_url') }}">{{ config('app.url_short') }}</a>
@endcomponent
