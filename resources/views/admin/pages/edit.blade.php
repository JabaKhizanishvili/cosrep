@extends('admin.layouts.app')
@section('title')
    Edit Page
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
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
                        <h4 class="">{{$object->slug}}</h4>
                        <form method="post" action="{{ route('admin.pages.update', $object->id) }}" id="submitForm"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            {{--                        <div class="form-row mb-4">--}}
                            {{--                            <div class="form-group col-md-12">--}}
                            {{--                                <label for="inputEmail4"> Name</label>--}}
                            {{--                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="name" placeholder="Name" name="name" value="{{$object->name}}" required>--}}
                            {{--                                @error('name')--}}
                            {{--                                    <div class="customValidate">--}}
                            {{--                                        {{ $message }}--}}
                            {{--                                    </div>--}}
                            {{--                                @enderror--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}

                            <div class="form-group shadow p-3 mb-5 bg-body rounded p-2 m-4">
                                <label for="language-select">აირჩიეთ ენა</label>
                                <select id="language-select" class="form-control">
                                    <option value="ge">🇬🇪 ქართული</option>
                                    <option value="en">🇬🇧 English</option>
                                </select>

                                <div class="lang-group mt-4" data-lang="ge">
                                    <label for="name_ge">სახელი (ქართული)</label>
                                    <input type="text" class="form-control" id="name_ge" placeholder="სახელი"
                                           name="name[ge]" value="{{ $object->getTranslation('name', 'ge') }}">
                                </div>

                                <div class="lang-group mt-4" data-lang="en" style="display: none;">
                                    <label for="name_en">Name (English)</label>
                                    <input type="text" class="form-control" id="name_en" placeholder="Name"
                                           name="name[en]" value="{{ $object->getTranslation('name', 'en') }}">
                                </div>
                            </div>

                            <script>
                                document.getElementById('language-select').addEventListener('change', function () {
                                    let selectedLang = this.value;

                                    document.getElementById('name-ge').style.display = selectedLang === 'ge' ? 'block' : 'none';
                                    document.getElementById('name-en').style.display = selectedLang === 'en' ? 'block' : 'none';
                                });
                            </script>


                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"> (SEO) Keywords</label>
                                    <input type="text" class="form-control @error('keyword') invalideInput @enderror"
                                           id="keyword" placeholder="(SEO) Keywords" name="keyword"
                                           value="{{$object->keyword}}">
                                    @error('keyword')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"> (SEO) Description</label>
                                    <input type="text"
                                           class="form-control @error('description') invalideInput @enderror"
                                           id="description" placeholder="(SEO) Description" name="description"
                                           value="{{$object->description}}">
                                    @error('description')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            @if($object->id != 1)
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
                                        <img src="{{ pageImage($object->image) }}" alt="" style="width: 100%">
                                    </div>
                                </div>
                            @endif

                            @if($object->slug != '/')
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Status (Active / Inactive)</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                                <input type="checkbox" id="status" name="status"
                                                       value="1" {{$object->status == 1 ? 'checked' : ''}} >
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
                            @endif


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
        @if($object->id != 1)
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        @endif
        window.addEventListener('DOMContentLoaded', (event) => {
            const submitForm = document.getElementById('submitForm');
            const submitButton = document.getElementById('submitButton');
            submitForm.addEventListener('submit', function () {
                submitButton.disabled = true;
            });
        });


        document.getElementById('language-select').addEventListener('change', function () {
            let selectedLang = this.value;

            document.querySelectorAll('.lang-group').forEach(group => {
                group.style.display = group.getAttribute('data-lang') === selectedLang ? 'block' : 'none';
            });
        });

    </script>

@endsection
