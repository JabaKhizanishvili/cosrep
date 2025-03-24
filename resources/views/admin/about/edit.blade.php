@extends('admin.layouts.app')
@section('title')
    About Us
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
                                <a target="_blank" href="{{ route('admin.sections.edit', 1) }}" class="btn btn-info">Edit
                                    Section</a>
                                <a target="_blank" href="{{ route('admin.trainers.index') }}" class="btn btn-info">Edit
                                    Trainers</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="post" action="{{ route('admin.about.update', $object->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Title (ქართულად)</label>

                                    <input type="text" class="form-control @error('title') invalideInput @enderror"
                                           id="phone" placeholder="Phone" name="title[ge]" value="{{$object->title}} "
                                           required>
                                    @error('title')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4 mt-2">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Title (English)</label>

                                    <input type="text" class="form-control @error('title') invalideInput @enderror"
                                           id="phone" placeholder="Phone" name="title[en]" value="{{$object->title}} "
                                           required>
                                    @error('title')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <hr>
                            <div class="form-row mb-4">

                                @if (!empty($object->stats))
                                    @php
                                        if (is_string($object->stats)) {
                                              $stats = json_decode($object->stats, true);
                                          } else {
                                              $stats = $object->getTranslations('stats');
                                          }

                                    @endphp

                                    @foreach ( $stats['ge'] ?? $stats as $key => $stat)
                                        <div class="form-group col-md-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Icon</label>
                                                <input type="text" class="form-control" id="phone"
                                                       name="stat_icon[]"
                                                       value="{{$stat['stat_icon']}}" required>
                                                @error('stat_icon.0')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Name (ქართულად)</label>
                                                <input type="text" class="form-control" id="phone"
                                                       name="stat_name_ge[]"
                                                       value="{{$stat['stat_name']}}" required>
                                                @error('stat_name.0')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Name (English)</label>
                                                <input type="text" class="form-control" id="phone"
                                                       name="stat_name_en[]"
                                                       value="{{ $stats['en'][$key]['stat_name'] ?? $stat['stat_name'] }}"
                                                       required>
                                                @error('stat_name.0')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class=" form-group col-md-12">
                                                <label for="inputEmail4">Number</label>
                                                <input type="text" class="form-control" id="phone"
                                                       name="stat_number[]"
                                                       value="{{$stat['stat_number']}}" required>
                                                @error('stat_number.0')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach

                                @else

                                    <div class="form-group col-md-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Icon</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_icon[]"
                                                   value="{{ old('stat_icon.0') }}" required>
                                            @error('stat_icon.0')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Name</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_name[]"
                                                   value="{{ old('stat_name.0') }}" required>
                                            @error('stat_name.0')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Number</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_number[]"
                                                   value="{{ old('stat_number.0') }}" required>
                                            @error('stat_number.0')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Icon</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_icon[]"
                                                   value="{{ old('stat_icon.1') }}" required>
                                            @error('stat_icon.1')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Name</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_name[]"
                                                   value="{{ old('stat_name.1') }}" required>
                                            @error('stat_name.1')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Number</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_number[]"
                                                   value="{{ old('stat_number.1') }}" required>
                                            @error('stat_number.1')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Icon</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_icon[]"
                                                   value="{{ old('stat_icon.2') }}" required>
                                            @error('stat_icon.2')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Name</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_name[]"
                                                   value="{{ old('stat_name.2') }}" required>
                                            @error('stat_name.2')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Number</label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="stat_number[]"
                                                   value="{{ old('stat_number.2') }}" required>
                                            @error('stat_number.2')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                @endif


                            </div>

                            <hr>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Text (ქართულად)</label>
                                    <textarea name="text[ge]" id="textarea_1" cols="30" rows="10" class="form-control"
                                              required>{{ $object->text }}</textarea>
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
                                    <textarea name="text[en]" id="textarea_2" cols="30" rows="10" class="form-control"
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
                                    <img src="{{ aboutImage($object->image) }}" alt="" style="width: 100%">
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
    <script src="{{ admin_styles('ckeditor/ckeditor.js') }}"></script>
    <script src="{{  admin_styles('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>


    <script>
        CKEDITOR.replace('textarea_1');
        CKEDITOR.replace('textarea_2');

        var firstUpload = new FileUploadWithPreview('myFirstImage')

    </script>

@endsection
