@extends('admin.layouts.app')
@section('title')
Edit Customer
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">
<link href="{{ admin_styles('crop/crop-select-js.min.css') }}" rel="stylesheet" type="text/css" />


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
                    <form method="post" action="{{ route('admin.customers.update', $object) }}" enctype="multipart/form-data" id="submitForm">
                        @csrf
                        @method('put')

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">organization</label>
                                <select class="placeholder js-states form-control basic" name="organization_id" id="organization_id" required>
                                    <option value="">Select organization</option>
                                    @foreach($organizations as $organization)
                                    <option value="{{ $organization->id }}" {{ $object->office->organization_id == $organization->id ? 'selected' : ''  }} >{{ $organization->id }} - {{ $organization->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization_id')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Office</label>
                                <select class="placeholder js-states form-control basic" name="office_id" id="office_id" required>
                                    @foreach($offices as $office)
                                    <option value="{{ $office->id }}" {{ $object->office_id == $office->id ? 'selected' : ''  }} >{{ $office->name }}</option>
                                    @endforeach
                                </select>
                                @error('office_id')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>


                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="name" placeholder="Name" name="name" value="{{$object->name}}" required>
                                @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control @error('email') invalideInput @enderror" id="inputEmail4" placeholder="Email" name="email" value="{{$object->email}}" required>
                                @error('email')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Username (Personal Number)</label>
                                <input type="number" class="form-control @error('username') invalideInput @enderror" id="username" placeholder="Personal Number" name="username" value="{{$object->username}}" minlength="11" maxlength="11" required>
                                @error('username')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row mb-4">

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">position</label>
                                <select class="placeholder js-states form-control basic" name="position_id" id="position_id" required>
                                    <option value="">Select position</option>
                                    @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ $object->position_id == $position->id ? 'selected' : ''  }} >{{ $position->id }} - {{ $position->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization_id')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>


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
                                <label for="inputPassword4">Generate</label>
                                <button class="form-control btn btn-success" id="generatePassword">Generate</button>
                            </div>
                        </div>


                      <button type="submit" class="btn btn-primary mt-3" id="submitButton">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT AREA -->
</div>


@endsection



@section('script')
<script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            var generateBtn = document.getElementById('generatePassword');
            var passwordInput = document.getElementById('password');
            generateBtn.addEventListener('click', function(e){
                e.preventDefault();
                passwordInput.value = generatePassword()

            })
        });


    $(".basic").select2({
    tags: true,
    });

    $('#organization_id').change(function(e){
        var organization_id = this.value
        ajaxCall('GET', '{{route('admin.customers.getOffices')}}', {"organization_id": organization_id}, function (e) {
            let result = e.data;
            let select = document.getElementById('office_id');
            select.innerHTML = '';
            let div = document.createElement('div');
                result.forEach(function (result) {
                    select.innerHTML += `<option value="${result.id}">${result.name}</option>`
                });
        });
    });
    </script>
@endsection
