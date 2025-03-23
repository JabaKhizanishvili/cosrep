@extends('admin.layouts.app')
@section('title')
    Edit terms / policy
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ admin_styles('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
@endsection


@section('content')

    <style>
        #customStatusContainer {
            display: none;
        }

        .gallery_container {
            display: flex;
            min-height: 200px;
            flex-wrap: wrap;
        }


        .single_gallery {
            width: 140px;
            height: 100px;
            position: relative;
            background: yellow;
            margin: 10px;
            margin-top: 0;
        }

        .single_gallery::before {
            content: "Remove";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0;
            height: 100%;
            background: red;
            cursor: pointer;
            transition: .3s;
            font-size: 20px;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .single_gallery:hover::before {
            opacity: 1;
        }

        .singleSimilar {
            background: red;
            width: 100px;
            height: 100px;
            border-radius: 5px;
            display: inline-block;
            margin: 10px;
            position: relative;

        }

        #selectSimilarProducts {
            max-height: 300px;
            overflow: scroll;
            display: flex;
            flex-wrap: wrap;

        }

        #similarProducts {
            display: flex;
            flex-wrap: wrap;
        }


        .singleBox:before {
            height: 100%;
            width: 100%;
            position: absolute;
            content: "Remove";
            background: yellow;
            border-radius: 5px;
            opacity: 0;
            transition: 0.5s;
            cursor: pointer;
            text-align: center;
            padding: 20px;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .singleBox:hover::before {
            opacity: 1;
        }

        .singleBox {
            max-height: 200px;
            overflow: scroll;
            width: 120px;
            text-align: center;
            position: relative;
        }


        .singleBoxDb:before {
            height: 100%;
            width: 100%;
            position: absolute;
            content: "ADD";
            background: black;
            border-radius: 5px;
            opacity: 0;
            transition: 0.5s;
            cursor: pointer;
            text-align: center;
            padding: 20px;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .singleBoxDb:hover::before {
            opacity: 1;
        }

        .singleBoxDb {
            max-height: 200px;
            overflow: scroll;
            width: 120px;
            text-align: center;
            position: relative;
        }

        .similarImg {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .custom-file-container__image-preview {
            height: 100px;
        }

        #scroll {
            transition: 1s;
        }


    </style>


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
                    <div class="widget-content widget-content-area" id="scroll">
                        <form method="post" action="{{ route('admin.policies.update', $object->id) }}"
                              enctype="multipart/form-data" id="create_form">
                            @csrf
                            @method('put')
                            <input type="hidden" name="exist_id" id="exist_id" value="{{ $object->id }}">

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Name (ქართულად)</label>
                                    <input type="text" class="form-control @error('name') invalideInput @enderror"
                                           id="name" placeholder="Name" name="name[ge]"
                                           value="{{$object->getTranslation('name', 'ge')}}"
                                           required>
                                    @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-4 col-md-12">
                                    <label for="inputEmail4">Name (english)</label>
                                    <input type="text" class="form-control @error('name') invalideInput @enderror"
                                           id="name" placeholder="Name" name="name[en]"
                                           value="{{$object->getTranslation('name', 'en')}}"
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
                                    <textarea name="text[ge]" id="textarea_1" cols="30" rows="10" class="form-control"
                                              required>{{ $object->getTranslation('text','ge') }}</textarea>
                                    @error('text')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 col-md-12">
                                    <label for="inputEmail4">Text (English)</label>
                                    <textarea name="text[en]" id="textarea_2" cols="30" rows="10" class="form-control"
                                              required>{{ $object->getTranslation('text', 'en') }}</textarea>
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



@section('script')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{  admin_styles('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{  admin_styles('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>

    <script>


    </script>

    <script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>

    <script src="{{ admin_styles('ckeditor/ckeditor.js') }}"></script>
    <script>
        @if($object->id != 3)
        CKEDITOR.replace('textarea_1');
        CKEDITOR.replace('textarea_2');
        $("form").submit(function (e) {
            var messageLength = CKEDITOR.instances['textarea_1'].getData().replace(/<[^>]*>/gi, '').length;
            var messageLength = CKEDITOR.instances['textarea_2'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {

                Snackbar.show({
                    text: 'Text field is required',
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'bottom-right',
                    duration: null
                });
                $('html, body').animate({
                    scrollTop: $("#textarea_1").offset().top + 200
                }, 700);

                $('html, body').animate({
                    scrollTop: $("#textarea_2").offset().top + 200
                }, 700);

                e.preventDefault();
            }
        });

        @endif

        function updateAllMessageForms() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }
    </script>

    <script>

        window.addEventListener('DOMContentLoaded', (event) => {


            $(".placeholder").select2({
                placeholder: "Make a Selection",
                allowClear: true
            });

        });
    </script>

@endsection
