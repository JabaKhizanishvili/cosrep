@extends('front.layouts.app')


@section('title')

@endsection


@section('css')

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection

@section('content')

    <main>
        <!-- breadcrumb banner content area start -->
        <div class="lernen_banner large" style="background: linear-gradient(rgba(0, 0, 0, .3), rgba(0, 0, 0, .1)), url({{ pageImage($page->image) }});">
            <div class="container">
                <div class="row">
                    <div class="lernen_banner_title">
                        <h1>{{ $page->name }}</h1>
                        <div class="lernen_breadcrumb">
                            <div class="breadcrumbs">
                                        <span class="first-item">
                                        <a href="{{ route('front.index') }}">მთავარი</a></span>
                                <span class="separator">&gt;</span>
                                <span class="last-item">{{ $page->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end breadcrumb banner content area start -->

        <!-- contact area start -->
        <div id="contact" class="wrap-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="dreidbgleft">
                            <img src="{{ contactImage($contact->image) }}" alt="Buy this Course">
                        </div>
                    </div>
                <div class="col-md-12 col-lg-6">
                    @if(session('success'))
                        <div class="text-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="themeioan-form-contact form" method="post" action="{{ route('front.sendEmail') }}">
                        @csrf
                        <!-- Change Placeholder and Title -->
                        <div>
                            <input class="input-text required-field" type="text" name="name" id="contactName"
                                placeholder="სახელი, გვარი" title="სახელი, გვარი" value="{{ old('name') }}"/>
                            @error('name')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <input class="input-text required-field email-field" type="email" name="email"
                                id="contactEmail" placeholder="ელ-ფოსტა" title="ელ-ფოსტა" value="{{ old('email') }}"/>
                            @error('email')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <input class="input-text required-field" type="text" name="subject" id="contactSubject"
                                placeholder="სათაური" title="სათაური" value="{{ old('subject') }}"/>
                            @error('subject')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                        <textarea class="input-text required-field" name="text" id="contactMessage"
                                placeholder="ტექსტი" title="ტექსტი">{{ old('text') }}</textarea>
                        @error('text')
                            <div class="error-msg">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <input class="color-two button" type="submit"
                            value="წერილის გაგზავნა"/>
                    </form>
                </div>

                <div class="col-lg-12" >
                    <div class="feature_contact_item fc_bg2">
                        <div class="opac">
                            <h3>დეტალები</h3>
                            <p>
                                @if($contact->address)
                                    {{ $contact->address }}<br>
                                @endif

                                @if($contact->email)
                                    Email: {{ $contact->email }}<br>
                                @endif

                                @if($contact->phone)
                                    Phone: {{ $contact->phone }}<br>
                                @endif
                            </p>
                            <div class="custom_contact">
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
            </div>
        </div>
        <!-- contact area end -->

        <div class="themeioan_contact_map">
            {!! $contact->map !!}
            </p>
        </div>
    </main>

@endsection
