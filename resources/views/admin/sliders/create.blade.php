@extends('admin.layouts.app')
@section('title')
Add Slider
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
                    <form method="post" action="{{ route('admin.sliders.store') }}" id="submitForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4"> Name</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="name" placeholder="Name" name="name" value="{{old('name')}}" required>
                                @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4"> URL</label>
                                <input type="url" class="form-control @error('url') invalideInput @enderror" id="url" placeholder="URL" name="url" value="{{old('url')}}">
                                @error('url')
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

                        </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Status (Active / Inactive)</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                            <input type="checkbox" id="status" name="status" value="1" checked >
                                            <span class="slider"></span>
                                        </label>
                                        @error('status')
                                        <div class="customValidate">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                      <button type="submit" class="btn btn-primary mt-3" id="submitButton">Create</button>
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
    const submitForm = document.getElementById('submitForm');
    const submitButton = document.getElementById('submitButton');
    submitForm.addEventListener('submit', function(){
        submitButton.disabled = true;
    });
});
</script>


@endsection
