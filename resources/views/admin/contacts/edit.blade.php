@extends('admin.layouts.app')
@section('title')
Contact Information
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
<link href="{{ admin_styles('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />

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
                    <form method="post" action="{{ route('admin.contacts.update', $object->id) }}"  enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Phone</label>

                                <input type="text" class="form-control @error('phone') invalideInput @enderror" id="phone" placeholder="Phone" name="phone" value="{{$object->phone}}" required>
                                @error('phone')
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
                                <label for="inputEmail4">Facebook Url</label>

                                <input type="url" class="form-control @error('facebook') invalideInput @enderror" id="facebook" placeholder="Facebook" name="facebook" value="{{$object->facebook}}">
                                @error('facebook')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">LinkedIn Url</label>

                                <input type="url" class="form-control @error('linkedin') invalideInput @enderror" id="linkedin" placeholder="LinkedIn" name="linkedin" value="{{$object->linkedin}}">
                                @error('linkedin')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>


                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Youtube Url</label>

                                <input type="url" class="form-control @error('youtube') invalideInput @enderror" id="facebook" placeholder="Youtube" name="youtube" value="{{$object->youtube}}">
                                @error('youtube')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Address</label>
                                <input type="text" class="form-control @error('address') invalideInput @enderror" id="inputEmail4" placeholder="Address" name="address" value="{{$object->address}}">
                                @error('address')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Google Map</label>

                                <textarea class="form-control @error('map') invalideInput @enderror" name="map" id="map" cols="30" rows="10">{{ $object->map }}</textarea>
                                @error('map')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <div class="widget-content widget-content-area">
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Upload Image  <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="image">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                </div>
                                @error('image')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Image </label>
                                <img src="{{ contactImage($object->image) }}" alt="" style="width: 100%">
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
<script src="{{  admin_styles('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
<script>

var firstUpload = new FileUploadWithPreview('myFirstImage')
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
