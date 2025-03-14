@extends('admin.layouts.app')
@section('title')
Edit Profile
@endsection

@section('content')
<div class="layout-px-spacing">


    <!-- CONTENT AREA -->


    <div class="row layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4></h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form method="post" action="{{ route('admin.profile.update', $object) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="page" value="{{ request('page') }}">

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="name" placeholder="Name" name="name" value="{{ $object->name }}" required >
                                @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control @error('email') invalideInput @enderror" id="inputEmail4" placeholder="Email" name="email" value="{{ $object->email }}" required readonly>
                                @error('email')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">

                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Password</label>
                                <input type="text" class="form-control @error('password') invalideInput @enderror" id="password" placeholder="Password" name="password">
                                @error('password')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputPassword4">Regenerate</label>
                                <button class="form-control btn btn-success" id="generatePassword">Regenerate</button>
                            </div>
                        </div>

                      <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT AREA -->
</div>


@endsection



@section('script')

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            var generateBtn = document.getElementById('generatePassword');
            var passwordInput = document.getElementById('password');
            generateBtn.addEventListener('click', function(e){
                e.preventDefault();
                passwordInput.value = generatePassword()

            })
        });
    </script>
@endsection
