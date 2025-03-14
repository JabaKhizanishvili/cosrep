@extends('admin.layouts.app')
@section('title')
Add Training Test
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

                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form method="post" action="{{ route('admin.trainings.addQuestion', $object) }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Question</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="question" placeholder="Question" name="question" value="{{old('question')}}" required>
                                @error('question')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="answers-container row" style="width: 100%">
                                <div class="form-group col-md-12">
                                <a class="btn btn-info addAnswer">+ Add Answer</a>
                                </div>
                                <div class="form-group col-md-3 single-answer">
                                    <label for="inputEmail4">Answer</label>
                                    <input type="text" class="form-control" placeholder="Answer" name="answers[]" required>
                                    <div class="mt-1">
                                        <input type="radio" checked name="correct" value="0"> Correct
                                    </div>
                                </div>
                            </div>
                        </div>
                      <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT AREA -->
    <hr>
    <h3>Existing Questions</h3>
    @foreach ($object->tests as $key => $test)

    <div class="row layout-top-spacing single-answer">
        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.trainings.deleteQuestion', $test) }}" class="btn-sm btn-danger delete-question">Delete</a>

        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form method="post" action="{{ route('admin.trainings.updateQuestion', $test) }}"  enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">#{{ $key + 1 }} Question</label>
                                <input type="text" class="form-control @error('name') invalideInput @enderror" id="question" placeholder="Question" name="question" value="{{$test->question}}" required>
                                @error('question')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="answers-container row" style="width: 100%">
                                <div class="form-group col-md-12">
                                <a class="btn btn-info addAnswer">+ Add Answer</a>
                                </div>
                                @foreach (json_decode($test->answers) as $k => $answer)
                                    <div class="form-group col-md-3 single-answer">
                                        <a class="removeAnswer btn-sm btn-danger">-</a>
                                        <label for="inputEmail4">Answer</label>
                                        <input type="text" class="form-control" placeholder="Answer" name="answers[]" required value="{{ $answer }}">
                                        <div class="mt-1">
                                            <input type="radio"  name="correct" value="{{ $k }}" {{ $test->correct == $k ? "checked" : '' }}> Correct
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                      <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>


@endsection

@section('script')
    <script>
        function answerContent(number){
            let content =
            `
                <a class="removeAnswer btn-sm btn-danger">-</a>
                <label for="inputEmail4">Answer</label>
                <input type="text" class="form-control" placeholder="Answer" name="answers[]" required>
                <div class="mt-1">
                    <input type="radio" name="correct" value="${number}"> Correct
                </div>
            `;
            return content;
        }

        document.body.addEventListener("click", function(e){
            if(e.target.classList.contains("addAnswer")){
                //display new answer div
                let div = document.createElement("div");
                div.classList.add("form-group");
                div.classList.add("col-md-3");
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


