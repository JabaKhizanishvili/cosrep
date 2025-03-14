@extends('admin.layouts.app')
@section('title')
Add Training
@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
<link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">
<link href="{{ admin_styles('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />



@endsection


<style>

    .single-answer{
        position: relative;
    }
    .removeAnswer{
        position: absolute;
        top:4px;
        right:16px;
        cursor: pointer;
    }
    .single-answer{
        position: relative;
        padding-bottom: 20px;

    }
    .delete-question{
        position: absolute;
        top:5px;
        right:20px;
        cursor: pointer;
        z-index: 1;
    }
</style>

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
                    <form method="post" action="{{ route('admin.trainings.store') }}" enctype="multipart/form-data" id="submitForm">
                        @csrf
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Trainer</label>
                                <select class="placeholder js-states form-control basic" name="trainer_id" id="trainer_id" required>
                                    @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}" {{ $trainer->id == old("trainer_id") ? 'selected' : '' }}>{{ $trainer->email }}</option>
                                    @endforeach
                                </select>
                                @error('trainer_id')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Category</label>
                                <select class="placeholder js-states form-control basic" name="category_id" id="category_id" required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old("category_id") ? 'selected' : '' }}> {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>


                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="name" placeholder="Name" name="name" value="{{old('name')}}" required>
                                @error('name')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Point To Pass</label>
                                <input type="number" min="1" class="form-control @error('name') invalideInput @enderror" id="point_to_pass" placeholder="Point To Pass" name="point_to_pass" value="{{old('point_to_pass')}}" required>
                                @error('point_to_pass')
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
                                        <input type="checkbox" id="status" name="status" checked value="1">
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

                        <hr>
                        <div class="form-row">
                            <div class="answers-container row" style="width: 100%">
                                <div class="form-group col-md-12">
                                    <a class="btn btn-info addAnswer">+ Add Resource</a>
                                </div>
                                @if(old('names'))
                                    @php
                                    $urls = old('urls');
                                    @endphp
                                        @foreach (old('names') as $k => $old)
                                            <div class="form-group col-md-12 single-answer">
                                                @if($k != 0)
                                                    <a class="removeAnswer btn-sm btn-danger">-</a>
                                                @endif
                                                <label for="inputEmail4">URL</label>
                                                <input type="text" class="form-control mb-2" placeholder="Name" name="names[]" value="{{ $old }}" required>
                                                <input type="text" class="form-control" placeholder="https://example.com" name="urls[]" value="{{ $urls[$k] }}" required>
                                            </div>
                                        @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>


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
<script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>
<script src="{{  admin_styles('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>

    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    $(".basic").select2({
    tags: true,
    });

    function answerContent(number){
            let content =
            `
                <a class="removeAnswer btn-sm btn-danger">-</a>
                <label for="inputEmail4">URL</label>
                <input type="text" class="form-control mb-2" placeholder="Name" name="names[]" required>
                <input type="url" class="form-control" placeholder="https://example.com" name="urls[]" required>
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
                let length = e.target.parentNode.parentNode.querySelectorAll(".single-answer").length
                div.innerHTML = answerContent(length);
                e.target.closest(".answers-container").append(div);
            }

            if(e.target.classList.contains("removeAnswer")){
                //display new answer div
                e.target.parentNode.remove()
            }
        })

    </script>
@endsection
