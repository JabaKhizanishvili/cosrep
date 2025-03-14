@extends('admin.layouts.app')
@section('title')
About Us
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
                    <form method="post" action="{{ route('admin.sections.update', $object->id) }}" enctype="multipart/form-data">

                        <input type="hidden" name="section_id" value="{{ $object->id }}">
                        @csrf
                        @method('put')
                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Title</label>
                                <input type="text" class="form-control @error('title') invalideInput @enderror" id="phone" placeholder="Title" name="title" value="{{$object->title}}" required>
                                @error('title')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Website Url</label>

                                <input type="url" class="form-control @error('url') invalideInput @enderror" id="website" placeholder="Website" name="url" value="{{$object->url}}">
                                @error('url')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        @if($object->id == 1)



                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">

                                <div class="answers-container row" style="width: 100%">
                                    @if(!empty($object->stats))
                                    @foreach (json_decode($object->stats) as $stat)
                                    <div class="form-group col-md-12 single-answer">
                                        <a class="removeAnswer btn-sm btn-danger">-</a>
                                        <label for="inputEmail4">List Item</label>
                                        <input type="text" class="form-control" placeholder="List Item" name="stat_list[]" value="{{ $stat }}">
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="form-group col-md-12">
                                    <a class="btn btn-info addAnswer">+ Add New List Item</a>
                                    </div>

                                    @error('stat_list')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    @error('stat_list.*')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                            </div>


                        </div>
                    @endif
                        @if($object->id == 2)
                            <div class="form-row mb-4">
                                @if(!empty($object->stats))

                                    @foreach (json_decode($object->stats) as $stat)

                                        <div class="form-group col-md-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Icon</label>
                                                <input type="text" class="form-control" id="phone" name="stat_icon[]" value="{{$stat->stat_icon}}" required>
                                                @error('stat_icon.0')
                                                    <div class="customValidate">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Name</label>
                                                <input type="text" class="form-control" id="phone" name="stat_name[]" value="{{$stat->stat_name}}" required>
                                                @error('stat_name.0')
                                                    <div class="customValidate">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Number</label>
                                                <input type="text" class="form-control" id="phone" name="stat_number[]" value="{{$stat->stat_number}}" required>
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
                                        <input type="text" class="form-control" id="phone" name="stat_icon[]" value="{{ old('stat_icon.0') }}" required>
                                        @error('stat_icon.0')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Name</label>
                                        <input type="text" class="form-control" id="phone" name="stat_name[]" value="{{ old('stat_name.0') }}" required>
                                        @error('stat_name.0')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Number</label>
                                        <input type="text" class="form-control" id="phone" name="stat_number[]" value="{{ old('stat_number.0') }}" required>
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
                                        <input type="text" class="form-control" id="phone" name="stat_icon[]" value="{{ old('stat_icon.1') }}" required>
                                        @error('stat_icon.1')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Name</label>
                                        <input type="text" class="form-control" id="phone" name="stat_name[]" value="{{ old('stat_name.1') }}" required>
                                        @error('stat_name.1')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Number</label>
                                        <input type="text" class="form-control" id="phone" name="stat_number[]" value="{{ old('stat_number.1') }}" required>
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
                                        <input type="text" class="form-control" id="phone"  name="stat_icon[]" value="{{ old('stat_icon.2') }}" required>
                                        @error('stat_icon.2')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Name</label>
                                        <input type="text" class="form-control" id="phone"  name="stat_name[]" value="{{ old('stat_name.2') }}" required>
                                        @error('stat_name.2')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Number</label>
                                        <input type="text" class="form-control" id="phone"  name="stat_number[]" value="{{ old('stat_number.2') }}" required>
                                        @error('stat_number.2')
                                            <div class="customValidate">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                @endif

                            </div>
                        @endif

                        <hr>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Text</label>
                                <textarea name="text" id="textarea_1" cols="30" rows="10" class="form-control" required>{{ $object->text }}</textarea>
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
                                <img src="{{ sectionImage($object->image) }}" alt="" style="width: 100%">
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status (Active / Inactive)</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                        <input type="checkbox" id="status" name="status" {{ $object->status == 1 ? 'checked' : '' }} value="1">
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
    CKEDITOR.replace( 'textarea_1' );
    var firstUpload = new FileUploadWithPreview('myFirstImage')

    function answerContent(){
            let content =
            `
                <a class="removeAnswer btn-sm btn-danger">-</a>
                <label for="inputEmail4">List Item</label>
                <input type="text" class="form-control" placeholder="List Item" name="stat_list[]" required>
            `;
            return content;
        }

        document.body.addEventListener("click", function(e){
            if(e.target.classList.contains("addAnswer")){
                //display new answer div
                let div = document.createElement("div");
                div.classList.add("form-group");
                div.classList.add("col-md-12");
                div.classList.add("single-answer");
                //count answers divs

                div.innerHTML = answerContent();
                e.target.closest(".answers-container").append(div);
            }

            if(e.target.classList.contains("removeAnswer")){
                //display new answer div
                e.target.parentNode.remove()
            }
        })
</script>


@endsection
