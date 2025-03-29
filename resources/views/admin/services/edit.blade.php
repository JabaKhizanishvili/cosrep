@extends('admin.layouts.app')
@section('title')
    Edit Service
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">
    <link href="{{ admin_styles('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
          type="text/css"/>

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
                        <form method="post" action="{{ route('admin.services.update', $object) }}"
                              enctype="multipart/form-data" id="submitForm">
                            @csrf
                            @method('put')

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Slug უნიკალური სახელი</label>
                                    <input type="text" class="form-control @error('slug') invalideInput @enderror"
                                           id="slug" placeholder="slug" name="slug" value="{{ $object->slug }}"
                                           required>
                                    @error('slug')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Name (ქართულად)</label>
                                    <input type="text" class="form-control @error('name') invalideInput @enderror"
                                           id="name" placeholder="Name" name="name[ge]" value="{{ $object->name }}"
                                           required>
                                    @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Name (English)</label>
                                    <input type="text" class="form-control @error('name') invalideInput @enderror"
                                           id="name" placeholder="Name" name="name[en]"
                                           value="{{ $object->getTranslation('name','en') }}"
                                           required>
                                    @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Text (ქართულად)</label>
                                    <textarea name="text[ge]" id="textarea_1" cols="30"
                                              rows="10" class="form-control"
                                              placeholder="Text" required>{{ $object->text }}</textarea>
                                    @error('text')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Text (English)</label>
                                    <textarea name="text[en]" id="textarea_2" cols="30"
                                              rows="10" class="form-control"
                                              placeholder="Text"
                                              required>{{ $object->getTranslation('text','en') }}</textarea>
                                    @error('text')
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
                                            <label>Upload Image <a href="javascript:void(0)"
                                                                   class="custom-file-container__image-clear"
                                                                   title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file">
                                                <input type="file"
                                                       class="custom-file-container__custom-file__custom-file-input"
                                                       accept="image/*" name="image">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                                <span
                                                    class="custom-file-container__custom-file__custom-file-control"></span>
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
                                    <img src="{{ ServicesImage($object->image) }}" alt="" style="width: 100%">
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
    <script src="{{ admin_styles('ckeditor/ckeditor.js') }}"></script>


    <script>


        CKEDITOR.replace('textarea_1', {
            filebrowserUploadUrl: "{{ route('admin.services.uploadMedia', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            filebrowserImageUploadUrl: "{{ route('admin.services.uploadMedia', ['_token' => csrf_token()]) }}",
            filebrowserBrowseUrl: "{{ route('admin.services.browseMedia') }}",  // Browse URL to fetch images
            filebrowserImageBrowseUrl: "{{ route('admin.services.browseMedia') }}",  // Same URL for images
        });

        CKEDITOR.replace('textarea_2', {
            filebrowserUploadUrl: "{{ route('admin.services.uploadMedia', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            filebrowserImageUploadUrl: "{{ route('admin.services.uploadMedia', ['_token' => csrf_token()]) }}",
            filebrowserBrowseUrl: "{{ route('admin.services.browseMedia') }}",  // Browse URL to fetch images
            filebrowserImageBrowseUrl: "{{ route('admin.services.browseMedia') }}",  // Same URL for images
        });

        var firstUpload = new FileUploadWithPreview('myFirstImage')
        $(".basic").select2({
            tags: true,
        });

    </script>
@endsection
