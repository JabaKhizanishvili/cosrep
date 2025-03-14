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
                        <h1>პაროლის აღდგენა</h1>
                        <div class="lernen_breadcrumb">
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
                            <img src="{{ front_styles('images/reset.jpeg') }}" alt="Buy this Course">
                        </div>
                    </div>
                <div class="col-md-12 col-lg-6">
                    @if(session('error'))
                        <div class="text-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="themeioan-form-contact form" action="{{ route('reset.password.post') }}" method="POST">
                        @csrf
                        <!-- Change Placeholder and Title -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mt-5">
                            <input class="input-text required-field email-field" type="text" name="username"
                                id="contactEmail" placeholder="Username" title="Username" value="{{ old('username') }}"/>
                            @error('username')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-1">
                            <input class="input-text required-field email-field" type="password" name="password"
                                id="contactEmail" placeholder="პაროლი" title="ელ-ფოსტა" value=""/>
                            @error('password')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-1">
                            <input class="input-text required-field email-field" type="password" name="password_confirmation"
                                id="contactEmail" placeholder="გაიმეორეთ პაროლი" title="ელ-ფოსტა" value=""/>
                            @error('password_confirmation')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <input class="color-two button" type="submit"
                            value="პაროლის აღდგენა"/>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <!-- contact area end -->

    </main>

@endsection
