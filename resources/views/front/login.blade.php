@extends('front.layouts.app')


@section('title')

@endsection


@section('css')
<style>
    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        cursor: pointer;
        user-select: none;

    }
</style>
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
                            {{-- <div class="breadcrumbs">
                                        <span class="first-item">
                                        <a href="index.html">Homepage</a></span>
                                <span class="separator">&gt;</span>
                                <span class="last-item">{{ $page->name }}</span>
                            </div> --}}
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
                            <img src="{{ front_styles('images/login.jpeg') }}" alt="Buy this Course">
                        </div>
                    </div>
                <div class="col-md-12 col-lg-6">
                    @if(session('error'))
                        <div class="text-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="text-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="themeioan-form-contact form" method="post" action="{{ route('front.login') }}">
                        @csrf
                        <!-- Change Placeholder and Title -->

                        <div class="mt-5">
                            <input class="input-text required-field email-field" type="text" name="username"
                                id="contactEmail" placeholder="Username" title="Username" value="{{ old('username') }}"/>
                            @error('username')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-2 mb-1 password-wrapper">
                            <input class="input-text required-field" type="password" name="password" id="password"
                                placeholder="Password" title="password" value="{{ old('password') }}"/>
                            <span class="toggle-password" id="eye-icon" onclick="togglePassword(this)" data-target="password">
                                <i class="bi bi-eye-fill"></i>
                            </span>
                            @error('password')
                                <div class="error-msg">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-1 mb-5 ">
                            <a  style="float: right; text-decoration:underline" href="{{ route('forget.password.get') }}">პაროლის აღდგენა</a>
                        </div>
                        <input class="color-two button" type="submit"
                            value="ავტორიზაცია"/>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <!-- contact area end -->

    </main>

@endsection

@section('js')
{{--    <script src="{{ front_styles("js/tab.js") }}?v=1256"></script>--}}
    <script>

        function togglePassword(element) {
            let passwordField = document.getElementById(element.getAttribute("data-target"));
            let eyeIcon = element.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text"; // პაროლის ჩვენება
                eyeIcon.classList.remove("bi-eye-fill");
                eyeIcon.classList.add("bi-eye-slash-fill");
            } else {
                passwordField.type = "password"; // პაროლის დამალვა
                eyeIcon.classList.remove("bi-eye-slash-fill");
                eyeIcon.classList.add("bi-eye-fill");

            }
        }

    </script>

@endsection
