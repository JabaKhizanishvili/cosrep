@extends('admin.layouts.app')
@section('title')
Appointment Test Result
@endsection

@section('css')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
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
    }
    .delete-question{
        position: absolute;
        top:5px;
        right:20px;
        cursor: pointer;
        z-index: 1;
    }

    .correct_answer{
        background: #cef5ce;
         padding:5px;
          display: inline-block;
          padding-left: 0px;
    }

    .wrong_answer{
        background: #ffd3df;
         padding:5px;
          display: inline-block;
          padding-left: 0px;
    }
</style>


@section('content')

<div class="layout-px-spacing">

    <div class="row layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <h4>Training</h4>
                            <ul>
                                <li><strong>ID: </strong>{{ $appointment->training->id }}</li>
                                <li><strong>NAME: </strong>{{ $appointment->training->name }}</li>
                            </ul>
                        </div>
                        <div class="form-group col-md-6">
                            <h4>Appointment</h4>
                            <ul>
                                <li><strong>ID: </strong>{{ $appointment->id }}</li>
                                <li><strong>NAME: </strong>{{ $appointment->name }}</li>
                                <li><strong>Start: </strong>{{ $appointment->start_date }}</li>
                                <li><strong>End: </strong>{{ $appointment->end_date }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-6">
                            <h4>Customer</h4>
                            <ul>
                                <li><strong>ID: </strong>{{ $object->customer->id }}</li>
                                <li><strong>NAME: </strong>{{ $object->customer->name }}</li>
                                <li><strong>EMAIL: </strong>{{ $object->customer->email }}</li>
                                <li><strong>Office: </strong>{{ $object->customer->office->name }}</li>


                            </ul>
                        </div>
                        <div class="form-group col-md-6">
                            <h4>Details</h4>
                            <ul>
                                <li><strong>Point To Pass: </strong>{{ $object->point_to_pass }}</li>
                                <li><strong>Final Point: </strong>{{ $object->final_point }}</li>
                                <li><strong>Passed: </strong>
                                    @if($object->passed())
                                    <span class="btn-sm btn-success text-white">Yes</span>
                                    @else
                                        <span class="btn-sm btn-danger text-white">No</span>
                                    @endif
                                </li>

                                <li><strong>Started At: </strong>{{ $object->satrted_at }}</li>
                                <li><strong>Finished At: </strong>{{ $object->finished_at }}</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT AREA -->
    <div class="row layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                        @if(!empty($$object->test))
                        @foreach (json_decode($object->test) as $key =>  $test)

                        @php
                            $customer_answer_numbers = json_decode($object->answers);
                            $test_answers = json_decode($test->answers);
                        @endphp

                        <div class="form-row">

                            <div class="form-group col-md-12">

                                <h5>#{{ $key + 1 }} {{ $test->question }}</h5>
                                <ul style="list-style: none">
                                    @php
                                    $customer_answer_numbers = json_decode($object->answers);
                                    $test_answers = json_decode($test->answers);
                                    @endphp
                                    @foreach ($test_answers as $k => $answer)
                                    @if($k == $test->correct)
                                    <li class="{{ $k == $test->correct ? 'correct_answer' : ''  }}">
                                        {{ $answer }}  (Correct answer)
                                      </li>
                                    @else
                                    <li class="">
                                        {{ $answer }}
                                      </li>
                                    @endif
                                    @endforeach
                                </ul>
                                <br>
                                <p>Customer answer: <span class="btn-sm btn-info text-white" style="text-transform: unset">{{ $test_answers[$customer_answer_numbers[$key]] }}</span></p>
                                <p>Point: <span class="btn-sm btn-info text-white">{{ $customer_answer_numbers[$key] == $test->correct ? '1' : '0' }}</span></p>
                            </div>
                        </div>
                        @endforeach
                        @endif

                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT AREA -->
</div>


@endsection



