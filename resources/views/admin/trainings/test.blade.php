@extends('admin.layouts.app')
@section('title')
    Add Training Test
@endsection

@section('css')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ admin_styles('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL STYLES -->
@endsection

<style>

    .single-answer {
        position: relative;
    }

    .removeAnswer {
        position: absolute;
        top: 4px;
        right: 16px;
        cursor: pointer;
    }

    .single-answer {
        position: relative;
    }

    .delete-question {
        position: absolute;
        top: 5px;
        right: 20px;
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
                        <form method="post" action="{{ route('admin.trainings.addQuestion', $object) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Question ქართულად</label>
                                    <input type="text" class="form-control @error('name') invalideInput @enderror"
                                           id="question" placeholder="Question" name="question[ge]"
                                           value="{{old('question')}}" required>
                                    @error('question')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Question English</label>
                                    <input type="text" class="form-control @error('name') invalideInput @enderror"
                                           id="question" placeholder="Question" name="question[en]"
                                           value="{{old('question')}}" required>
                                    @error('question')
                                    <div class="customValidate">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="answers-container row" style="width: 100%">
                                    <div class="form-group col-md-12">
                                        <a class="btn btn-info addAnswer">+ Add Answer (ქართულად)</a>
                                    </div>
                                    <div class="form-group col-md-3 single-answer">
                                        <label for="inputEmail4">Answer (ქართულად)</label>
                                        <input type="text" class="form-control" placeholder="Answer (ქართულად)"
                                               name="answers[ge][]"
                                               required>
                                        {{--                                        <div class="mt-1">--}}
                                        {{--                                            <input type="radio" checked name="correct" value="0"> Correct--}}
                                        {{--                                        </div>--}}

                                        <label for="inputEmail4">Answer (English)</label>
                                        <input type="text" class="form-control" placeholder="Answer (English)"
                                               id="correcten"
                                               name="answers[en][]"
                                               required>
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
                <a onclick="return confirm('Are you sure?')" href="{{ route('admin.trainings.deleteQuestion', $test) }}"
                   class="btn-sm btn-danger delete-question">Delete</a>

                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12"></div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="post" action="{{ route('admin.trainings.updateQuestion', $test) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">#{{ $key + 1 }} Question (ქართულად)</label>
                                        <input type="text"
                                               class="form-control @error('question') invalideInput @enderror"
                                               id="question" placeholder="Question" name="question[ge]"
                                               value="{{$test->question}}" required>
                                        @error('question')
                                        <div class="customValidate">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <label class="mt-2" for="inputEmail4">#{{ $key + 1 }} Question (English)</label>
                                        <input type="text"
                                               class="form-control @error('question') invalideInput @enderror"
                                               id="question" placeholder="Question (English)" name="question[en]"
                                               value="{{$test->getTranslation('question','en')}}" required>
                                        @error('question')
                                        <div class="customValidate">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="answers-container row m-2" style="width: 100%">
                                        <div class="form-group col-md-12">
                                            <a class="btn btn-info addAnswer">+ Add Answer</a>
                                        </div>

                                        @php
                                            $answersGe = $test->getTranslation('answers', 'ge') ?? [];
                                            $answersEn = $test->getTranslation('answers', 'en') ?? [];

                                            if(is_string($answersEn)){
                                                $answersEn = json_decode($answersEn);
                                            }
                                            if(is_string($answersGe)){
                                                $answersGe = json_decode($answersGe);
                                            }
                                            $correct = $test->correct;
                                        @endphp

                                        @foreach ($answersGe as $k => $answerGe)
                                            <div class="form-group col-md-3 single-answer">
                                                <a class="removeAnswer btn-sm btn-danger">-</a>
                                                <label>Answer (ქართულად)</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Answer (ქართულად)"
                                                       name="answers[ge][]" required value="{{ $answerGe }}">

                                                <div class="mt-1">

                                                </div>

                                                <label class="mt-1">Answer (English)</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Answer (English)"
                                                       name="answers[en][]" required
                                                       value="{{ $answersEn[$k] ?? '' }}">

                                                <div class="mt-1">
                                                    <input type="radio" name="correct"
                                                           value="{{ $k }}" {{ $correct == $k ? "checked" : '' }}>
                                                    Correct
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div> <!-- form-row დასრულდა -->
                            </form> <!-- აქ იყო პრობლემა, form არ იკეტებოდა -->
                        </div> <!-- widget-content დასრულდა -->
                    </div> <!-- statbox დასრულდა -->
                </div> <!-- col-lg-12 დასრულდა -->
            </div> <!-- row დასრულდა -->
        @endforeach


    </div>

@endsection

@section('script')
    <script>
        function answerContent(number) {
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


        document.body.addEventListener("click", function (e) {
            if (e.target.classList.contains("addAnswer")) {
                let container = e.target.closest(".answers-container");
                let length = container.querySelectorAll(".single-answer").length;
                let div = document.createElement("div");
                div.classList.add("form-group", "col-md-3", "single-answer");

                div.innerHTML = `
            <label>Answer (ქართულად)</label>
            <input type="text" class="form-control" placeholder="Answer (ქართულად)" name="answers[ge][]" required>
            <label>Answer (English)</label>
            <input type="text" class="form-control" placeholder="Answer (English)" name="answers[en][]" required>
            <div class="mt-1">
                <input type="radio" name="correct" value="${length}"> Correct
            </div>
            <button type="button" class="btn btn-danger removeAnswer">Remove</button>
        `;

                container.appendChild(div);
            }

            if (e.target.classList.contains("removeAnswer")) {
                e.target.closest(".single-answer").remove();
            }
        });

    </script>
@endsection


