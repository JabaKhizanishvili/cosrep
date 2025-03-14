@extends('admin.layouts.app')
@section('title')
Edit Appointment
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ admin_styles('plugins/select2/select2.min.css') }}">
<link href="{{ admin_styles('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ admin_styles('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">



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
                    <form method="post" action="{{ route('admin.appointments.update', $object) }}" enctype="multipart/form-data" id="submitForm">
                        @csrf
                        @method('put')

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Training</label>
                                <select class="placeholder js-states form-control basic" name="training_id" id="training_id" required>
                                    @foreach($trainings as $training)
                                    <option value="{{ $training->id }}" {{ $training->id == $object->training_id ? 'selected' : '' }}>{{ $training->id }} : {{ $training->name }}</option>
                                    @endforeach
                                </select>
                                @error('training_id')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                        </div>


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
                                <label for="inputEmail4">Start Date</label>
                                <input id="dateTimeFlatpickr" value="{{$object->start_date}}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." name="start_date">
                                @error('start_date')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Duration</label>
                                <input type="number" min="1" class="form-control @error('duration') invalideInput @enderror" id="duration" placeholder="Duration" name="duration" value="{{$object->getDuration()}}" required>
                                @error('duration')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Repeat In (number of month)</label>
                                <input type="number" min="1" class="form-control @error('repeat') invalideInput @enderror" id="repeat" placeholder="Repeat In (number of month)" name="repeat" value="{{$object->repeat}}" required>
                                @error('repeat')
                                <div class="customValidate">
                                    {{ $message }}
                                </div>
                                @enderror
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
<script src="{{ admin_styles('plugins/select2/select2.min.js') }}"></script>
<script src="{{  admin_styles('plugins/flatpickr/flatpickr.js') }}"></script>


    <script>
        var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            time_24hr: true
        });
        $(".basic").select2({
        tags: true,
        });

    </script>
@endsection
