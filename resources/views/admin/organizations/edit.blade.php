@extends('admin.layouts.app')
@section('title')
Edit Organization
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">


    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ admin_styles('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->

<style>
    .cat_image{
        width: 100%;
        height: auto;
        object-fit: contain;
    }
</style>
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
                    <form method="post" action="{{ route('admin.organizations.update', $object->id) }}"  enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="page" value="{{ request('page') }}">
                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4"> Name</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="name" placeholder="Name" name="name" value="{{$object->name}}" required>
                                @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
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
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Text</label>
                                <textarea name="text" id="textarea_1" cols="30" rows="10" class="form-control" placeholder="Text">{{ $object->text }}</textarea>
                                @error('text')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
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

