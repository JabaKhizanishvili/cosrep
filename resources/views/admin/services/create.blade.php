@extends('admin.layouts.app')
@section('title')
Add Service
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
                    <form method="post" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" id="submitForm">
                        @csrf


                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Name</label>
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
                                <label for="inputEmail4">Text</label>
                                <textarea name="text" id="textarea_1" cols="30" rows="10" class="form-control" placeholder="Text" required>{{ old('text') }}</textarea>
                                @error('text')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
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
<script src="{{ admin_styles('ckeditor/ckeditor.js') }}"></script>
    <script>
            CKEDITOR.replace( 'textarea_1' );
    </script>
@endsection
