@extends('admin.layouts.app')
@section('title')
    Add Training Media
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ admin_styles('assets/css/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('plugins/drag-and-drop/dragula/dragula.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ admin_styles('plugins/drag-and-drop/dragula/example.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->

    <style>
        .existingMedia {
            word-break: break-all;
            background: beige;
            padding: 25px;
            position: relative;
        }

        .deleteExistingMedia {
            position: absolute;
            top: 5px;
            right: 5px;

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

                        <form action="{{route('admin.trainings.media')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    {{--                                    @foreach(config('app.available_locales') as $key => $value)--}}
                                    {{--                                        <label class="mt-2" for="inputEmail4">Type [{{$value}}]</label>--}}

                                    {{--                                        <select class="placeholder mt-2 border-2 js-states form-control basic"--}}
                                    {{--                                                @foreach(\App\Models\TrainingMedia::TYPE_ARRAY as $type)--}}
                                    {{--                                                    name="type[{{$value}}]"--}}
                                    {{--                                                id="type"--}}
                                    {{--                                                required>--}}
                                    {{--                                            <option value="{{ $type }}">--}}
                                    {{--                                                {{ $type}}--}}
                                    {{--                                            </option>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        </select>--}}

                                    {{--                                    @endforeach--}}

                                    <label class="mt-2" for="inputEmail4">Type</label>

                                    <select class="placeholder mt-2 border-2 js-states form-control basic"
                                            @foreach(\App\Models\TrainingMedia::TYPE_ARRAY as $type)
                                                name="type"
                                            id="type"
                                            required>
                                        <option value="{{ $type }}">
                                            {{ $type}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name (ქართულად)</label>
                                    <input type="text" class="form-control" name="name[ge]" id="name">
                                </div>
                            </div>

                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name (English)</label>
                                    <input type="text" class="form-control" name="name[en]" id="name">
                                </div>
                            </div>


                            <input type="hidden" name="training_id" id="training_id" value="{{ $object->id }}">
                            @foreach(config('app.available_locales') as $lang)
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <div
                                            class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                                            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                                                <div
                                                    class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                                                    <div class="grid grid-cols-1 md:grid-cols-1">
                                                        <div class="p-6">
                                                            <div class="flex items-center">
                                                                <input type="hidden" name="file_{{ $lang }}"
                                                                       id="file_{{$lang}}"/>
                                                                <h3>{{ $lang === 'ge' ? 'ფაილის ატვირთვა ქართულად' : 'ფაილის ატვირთვა English' }}</h3>
                                                                <x-input.uppy
                                                                    :locale="$lang"
                                                                    :hiddenField="'file_'.$lang"
                                                                    :uploadElementClass="'upload-'.$lang"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary" value="">Submit</button>

                        </form>


                    </div>

                    <div class="widget-content widget-content-area">
                        <div class="col-md-12 pl-0">
                            <div id=' left-lovehandles
                                                        ' class='dragula ui-sortable'>
                                @foreach ($object->media as $key=> $m)
                                    <div
                                        class="media d-block d-xl-flex recordTr singleSort ml-0 pl-0"
                                        id="{{ $m->id }}">
                                        <ul class="list-inline people-liked-img text-center text-sm-left">
                                            <li class="list-inline-item badge-notify mr-0"
                                                style="color: #2196f3;
                                    padding: 5px;
                                    padding-top: 0;
                                    font-size: 18px;">
                                                # {{ $key + 1 }}
                                                <div class="notification">
                                                    <span class="badge badge-new"></span>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="media-body">
                                            <div
                                                class="d-sm-flex d-block justify-content-between text-sm-left text-center">

                                                <div class="col-md-6 existingMedia">
                                                    <a href="{{ route("admin.trainings.deleteMedia", $m) }}"
                                                       onclick="return confirm('Are you sure?')"
                                                       class="deleteExistingMedia btn-sm btn-danger">Delete</a>
                                                    <form
                                                        action="{{ route('admin.trainings.updateMedia', $m) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <ul>
                                                            <li>TYPE: {{ $m->type }}</li>
                                                            <li>NAME: (ქართულად) <input type="text"
                                                                                        name="name[ge]" id=""
                                                                                        value="{{ $m->name }}"
                                                                                        class="form-control">
                                                            </li>

                                                            <li>NAME: (English) <input type="text"
                                                                                       name="name[en]" id=""
                                                                                       value="{{ $m->getTranslation('name','en') }}"
                                                                                       class="form-control">
                                                            </li>


                                                            <li>URL: <a
                                                                    href="{{ amazon_s3_url($m->path) }}"
                                                                    target="_blank">{{ amazon_s3_url($m->path) }}</a>
                                                            </li>
                                                            @if($m->type == \App\Models\TrainingMedia::TYPE_DOCUMENT)
                                                                <embed
                                                                    src="{{ amazon_s3_url($m->path) }}#toolbar=0"
                                                                    type="application/pdf"
                                                                    width="100%"
                                                                    height="600px"/>
                                                            @elseif($m->type == \App\Models\TrainingMedia::TYPE_VIDEO)
                                                                <video width="320" height="240"
                                                                       controls
                                                                       controlsList="nodownload">
                                                                    <source
                                                                        src="{{ amazon_s3_url($m->path) }}"
                                                                        type="video/mp4">
                                                                    Your browser does not
                                                                    support the video tag.
                                                                </video>
                                                            @endif
                                                        </ul>
                                                        <button class="mt-2 btn-sm btn-warning">
                                                            Update
                                                        </button>
                                                        {{-- <input type="submit" name="name" class="mt-2 btn-sm btn-warning" id="" value="{{ $m->name }}"> --}}
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <!-- CONTENT AREA -->
    </div>

@endsection



@section('script')
    <script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script
        src="{{ admin_styles('plugins/drag-and-drop/dragula/dragula.min.js') }}"></script>
    <script
        src="{{ admin_styles('plugins/drag-and-drop/dragula/custom-dragula.js') }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>

        $(".basic").select2({
            tags: true,
        });


        $(".ui-sortable").sortable({
            delay: 150,
            stop: function () {
                var selectedData = new Array();
                $('.ui-sortable>.singleSort').each(function () {

                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);

            }
        });


        function updateOrder(data) {

            ajaxCall('POST', '{{route('admin.media.position')}}', {"position": data}, function (e) {
                Snackbar.show({
                    text: 'Position Updated successfully',
                    actionTextColor: '#fff',
                    backgroundColor: '#8dbf42',
                    pos: 'bottom-right'
                });
            });

        }

    </script>
@endsection
