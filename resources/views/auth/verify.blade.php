@extends('auth.layouts.app')


@section('content')


<h1 class="">Verify Email Address</span></a></h1>
                        <p class="signup-link">
                            {{-- New Here? <a href="auth_register.html">Create an account</a> --}}
                        </p>

                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        @endif


                        {{-- {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, --}}

                        @if($authType == \App\Models\AuthType::TYPE_CUSTOMER)
                            <form method="POST" action="{{ route('customer.sendVerifyEmail') }}" class="text-left">
                        @elseif($authType == \App\Models\AuthType::TYPE_GUIDE)
                            <form method="POST" action="{{ route('guide.sendVerifyEmail') }}" class="text-left">
                        @else
                            <form method="POST" action="{{ route('verification.resend') }}" class="text-left">
                        @endif

                            @csrf
                            <div class="form">


                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="d-sm-flex justify-content-between mt-5">
                                    <button type="submit" class="btn btn-primary">{{ __('click here to request verify email') }}</button>.
                                </div>



                            </div>
                        </form>
                        <hr>

                         @if($authType == \App\Models\AuthType::TYPE_CUSTOMER)
                            <a class="" href="{{ route('customer.logout') }}"   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @elseif($authType == \App\Models\AuthType::TYPE_GUIDE)
                            <a class="" href="{{ route('guide.logout') }}"   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('guide.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a class="" href="{{ route('logout') }}"   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            logout</a>

                    </div>


@endsection
