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
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="post" action="{{ route('admin.sections.update', $object->id) }}"
                              enctype="multipart/form-data">

                            <input type="hidden" name="section_id" value="{{ $object->id }}">
                            @csrf
                            @method('put')
                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Title (ქართულად)</label>
                                    <input type="text" class="form-control @error('title') invalideInput @enderror"
                                           id="phone" placeholder="Title" name="title[ge]" value="{{$object->title}}"
                                           required>
                                    @error('title')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Title (English)</label>
                                    <input type="text" class="form-control @error('title') invalideInput @enderror"
                                           id="phone" placeholder="Title" name="title[en]"
                                           value="{{$object->getTranslation('title','en')}}"
                                           required>
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

                                    <input type="url" class="form-control @error('url') invalideInput @enderror"
                                           id="website" placeholder="Website" name="url" value="{{$object->url}}">
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
                                    <div class="form-group col-md-10">

                                        <div class="answers-container row-cols-12" style="width: 100%">
                                            @php
                                                // 1. მივიღოთ ყველა თარგმანი
                                                $statsTranslations = $object->getTranslations('stats');

                                                // 2. დავამუშავოთ ქართული ვერსია
                                                $geStats = is_string($statsTranslations['ge'] ?? null) ? json_decode($statsTranslations['ge'], true) : ($statsTranslations['ge'] ?? []);

                                                // 3. დავამუშავოთ ინგლისური ვერსია
                                                $enStats = is_string($statsTranslations['en'] ?? null) ? json_decode($statsTranslations['en'], true) : ($statsTranslations['en'] ?? []);
                                            @endphp

                                            @if(!empty($geStats) && is_array($geStats))
                                                @foreach ($geStats as $key => $stat)
                                                    <div class="m-2 shadow p-3 mb-5 bg-body cols-md-8 rounded">
                                                        <a style="cursor: pointer"
                                                           class="removeAnswer btn-sm btn-danger">-</a>
                                                        <div class="mt-2 form-group col-12 single-answer">
                                                            <label for="inputEmail4">List Item (ქართულად)</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="List Item"
                                                                   name="stat_list[ge][]" value="{{ $stat }}">
                                                        </div>

                                                        <div class="form-group mt-2 col-md-12 single-answer">
                                                            <label for="inputEmail4">List Item (English)</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="List Item"
                                                                   name="stat_list[en][]"
                                                                   value="{{ $enStats[$key] ?? '' }}">
                                                        </div>
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

                                    {{--                                    @if (!empty($object->stats))--}}
                                    {{--                                        @php--}}
                                    {{--                                            if (is_string($object->stats)) {--}}
                                    {{--                                                  $stats = json_decode($object->stats, true);--}}
                                    {{--                                              } else {--}}
                                    {{--                                                  $stats = $object->getTranslations('stats');--}}
                                    {{--                                              }--}}

                                    {{--                                        @endphp--}}

                                    {{--                                        @foreach ( $stats['ge'] ?? $stats as $key => $stat)--}}
                                    {{--                                            <div class="form-group col-md-4">--}}
                                    {{--                                                <div class="form-group col-md-12">--}}
                                    {{--                                                    <label for="inputEmail4">Icon</label>--}}
                                    {{--                                                    <input type="text" class="form-control" id="phone"--}}
                                    {{--                                                           name="stat_icon[]"--}}
                                    {{--                                                           value="{{$stat['stat_icon']}}" required>--}}
                                    {{--                                                    @error('stat_icon.0')--}}
                                    {{--                                                    <div class="customValidate">--}}
                                    {{--                                                        {{ $message }}--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                    @enderror--}}
                                    {{--                                                </div>--}}

                                    {{--                                                <div class="form-group col-md-12">--}}
                                    {{--                                                    <label for="inputEmail4">Name (ქართულად)</label>--}}
                                    {{--                                                    <input type="text" class="form-control" id="phone"--}}
                                    {{--                                                           name="stat_name_ge[]"--}}
                                    {{--                                                           value="{{$stat['stat_name']}}" required>--}}
                                    {{--                                                    @error('stat_name.0')--}}
                                    {{--                                                    <div class="customValidate">--}}
                                    {{--                                                        {{ $message }}--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                    @enderror--}}
                                    {{--                                                </div>--}}

                                    {{--                                                <div class="form-group col-md-12">--}}
                                    {{--                                                    <label for="inputEmail4">Name (English)</label>--}}
                                    {{--                                                    <input type="text" class="form-control" id="phone"--}}
                                    {{--                                                           name="stat_name_en[]"--}}
                                    {{--                                                           value="{{ $stats['en'][$key]['stat_name'] ?? $stat['stat_name'] }}"--}}
                                    {{--                                                           required>--}}
                                    {{--                                                    @error('stat_name.0')--}}
                                    {{--                                                    <div class="customValidate">--}}
                                    {{--                                                        {{ $message }}--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                    @enderror--}}
                                    {{--                                                </div>--}}

                                    {{--                                                <div class=" form-group col-md-12">--}}
                                    {{--                                                    <label for="inputEmail4">Number</label>--}}
                                    {{--                                                    <input type="text" class="form-control" id="phone"--}}
                                    {{--                                                           name="stat_number[]"--}}
                                    {{--                                                           value="{{$stat['stat_number']}}" required>--}}
                                    {{--                                                    @error('stat_number.0')--}}
                                    {{--                                                    <div class="customValidate">--}}
                                    {{--                                                        {{ $message }}--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                    @enderror--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        @endforeach--}}

                                    @if (!empty($object->stats))
                                        @php
                                            // 1. მონაცემების მომზადება
                                            $rawStats = $object->stats;

                                            // 2. დეკოდირება თუ საჭიროა
                                            if (is_string($rawStats)) {
                                                $stats = json_decode($rawStats, true);
                                            } else {
                                                $stats = $object->getTranslations('stats');
                                            }

                                            // 3. ქართული ვერსიის მიღება
                                            $geStats = is_array($stats['ge'] ?? null) ? $stats['ge'] : [];

                                            // 4. ინგლისური ვერსიის მიღება
                                            $enStats = is_array($stats['en'] ?? null) ? $stats['en'] : [];

                                            // 5. თუ მონაცემები არ არის ენის მიხედვით დაყოფილი
                                            if (empty($geStats) && !empty($stats) && isset($stats[0]['stat_name'])) {
                                                $geStats = $stats;
                                                $enStats = $stats;
                                            }
                                        @endphp

                                        @if(!empty($geStats))
                                            @foreach ($geStats as $key => $stat)
                                                <div class="form-group col-md-4">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4">Icon</label>
                                                        <input type="text" class="form-control" name="stat_icon[]"
                                                               value="{{ $stat['stat_icon'] ?? '' }}" required>
                                                        @error('stat_icon.'.$key)
                                                        <div class="customValidate">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Name (ქართულად)</label>
                                                        <input type="text" class="form-control" name="stat_name_ge[]"
                                                               value="{{ $stat['stat_name'] ?? '' }}" required>
                                                        @error('stat_name_ge.'.$key)
                                                        <div class="customValidate">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Name (English)</label>
                                                        <input type="text" class="form-control" name="stat_name_en[]"
                                                               value="{{ $enStats[$key]['stat_name'] ?? $stat['stat_name'] ?? '' }}"
                                                               required>
                                                        @error('stat_name_en.'.$key)
                                                        <div class="customValidate">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Number</label>
                                                        <input type="text" class="form-control" name="stat_number[]"
                                                               value="{{ $stat['stat_number'] ?? '' }}" required>
                                                        @error('stat_number.'.$key)
                                                        <div class="customValidate">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    @else

                                        <div class="form-group col-md-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Icon</label>
                                                <input type="text" class="form-control" id="phone" name="stat_icon[]"
                                                       value="{{ old('stat_icon.0') }}" required>
                                                @error('stat_icon.0')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Name</label>
                                                <input type="text" class="form-control" id="phone" name="stat_name[]"
                                                       value="{{ old('stat_name.0') }}" required>
                                                @error('stat_name.0')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Number</label>
                                                <input type="text" class="form-control" id="phone" name="stat_number[]"
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
                                                <input type="text" class="form-control" id="phone" name="stat_icon[]"
                                                       value="{{ old('stat_icon.1') }}" required>
                                                @error('stat_icon.1')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Name</label>
                                                <input type="text" class="form-control" id="phone" name="stat_name[]"
                                                       value="{{ old('stat_name.1') }}" required>
                                                @error('stat_name.1')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Number</label>
                                                <input type="text" class="form-control" id="phone" name="stat_number[]"
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
                                                <input type="text" class="form-control" id="phone" name="stat_icon[]"
                                                       value="{{ old('stat_icon.2') }}" required>
                                                @error('stat_icon.2')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Name</label>
                                                <input type="text" class="form-control" id="phone" name="stat_name[]"
                                                       value="{{ old('stat_name.2') }}" required>
                                                @error('stat_name.2')
                                                <div class="customValidate">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputEmail4">Number</label>
                                                <input type="text" class="form-control" id="phone" name="stat_number[]"
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
                            @endif

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
                                              required>{{ $object->getTranslation('text', 'en') }}</textarea>
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
                                    <img src="{{ sectionImage($object->image) }}" alt="" style="width: 100%">
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Status (Active / Inactive)</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <label class="switch s-icons s-outline  s-outline-success  mb-4 mr-2">
                                            <input type="checkbox" id="status" name="status"
                                                   {{ $object->status == 1 ? 'checked' : '' }} value="1">
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
        CKEDITOR.replace('textarea_1');
        CKEDITOR.replace('textarea_2');
        var firstUpload = new FileUploadWithPreview('myFirstImage')

        function answerContent() {
            let content =
                `
                <a class="removeAnswer btn-sm btn-danger">-</a>
                <label for="inputEmail4">List Item</label>
                <input type="text" class="form-control" placeholder="List Item" name="stat_list[]" required>
            `;
            return content;
        }

        document.body.addEventListener("click", function (e) {
            if (e.target.classList.contains("addAnswer")) {
                //display new answer div
                let div = document.createElement("div");
                div.classList.add("form-group");
                div.classList.add("col-md-12");
                div.classList.add("single-answer");
                //count answers divs

                div.innerHTML = answerContent();
                div.innerHTML = `
                 <div class="m-2 shadow p-3 mb-5 bg-body cols-md-8 rounded">
                                                        <a style="cursor: pointer"
                                                           class="removeAnswer btn-sm btn-danger">-</a>
                                                        <div class="mt-2 form-group col-12 single-answer">
                                                            <label for="inputEmail4">List Item (ქართულად)</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="List Item"
                                                                   name="stat_list[ge][]" value="">
                                                        </div>

                                                        <div class="form-group mt-2 col-md-12 single-answer">
                                                            <label for="inputEmail4">List Item (English)</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="List Item"
                                                                   name="stat_list[en][]" value="">
                                                        </div>
                                                    </div>
                `;


                e.target.closest(".answers-container").append(div);
            }

            if (e.target.classList.contains("removeAnswer")) {
                //display new answer div
                e.target.parentNode.remove()
            }
        })
    </script>

@endsection
