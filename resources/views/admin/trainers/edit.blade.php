@extends('admin.layouts.app')
@section('title')
Edit Customer
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
                    <form method="post" action="{{ route('admin.trainers.update', $object) }}" enctype="multipart/form-data" id="submitForm">
                        @csrf
                        @method('put')

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
                                <label for="inputEmail4">Facebook Url</label>

                                <input type="url" class="form-control @error('facebook') invalideInput @enderror" id="facebook" placeholder="Facebook" name="facebook" value="{{$object->facebook}}">
                                @error('facebook')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Twitter Url</label>

                                <input type="url" class="form-control @error('linkedin') invalideInput @enderror" id="linkedin" placeholder="Twitter" name="twitter" value="{{$object->twitter}}">
                                @error('twitter')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Linkedin Url</label>

                                <input type="url" class="form-control @error('linkedin') invalideInput @enderror" id="linkedin" placeholder="Linkedin" name="linkedin" value="{{$object->linkedin}}">
                                @error('linkedin')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Instagram Url</label>

                                <input type="url" class="form-control @error('Instagram') invalideInput @enderror" id="Instagram" placeholder="Instagram" name="instagram" value="{{$object->instagram}}">
                                @error('Instagram')
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
                                <img src="{{ trainerImage($object->image) }}" alt="" style="width: 200px; height: 200px; object-fit:contain">
                                </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <div class="widget-content widget-content-area">
                                    <div class="custom-file-container" data-upload-id="mySignature">
                                        <label>Upload Signature  <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="signature" required>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                        </label>
                                        <div class="custom-file-container__image-preview"></div>
                                    </div>
                                </div>
                                @error('signature')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Signature </label>
                                <img src="{{ signatureImage($object->signature) }}" alt="" style="width: 200px; height: 200px; object-fit:contain">
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
<script src="{{  admin_styles('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>


    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        var firstUpload = new FileUploadWithPreview('mySignature')

    </script>
@endsection
