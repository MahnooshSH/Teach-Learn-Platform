@extends('course.course_management.course_management')


@section('manage_course')


    <div class="card">
        <div class="card-body">
            <div class="card-header text-center">
                {{__('text.Make and Edit Quiz')}}
            </div>

            <div class="card" style="background-color: #fafafa">
                <div class="card-header">
                    {{__('text.Quiz Information')}}
                </div>
                <div class="card-body">

                    <div id="quiz_info">
                    <div id="quiz_information_show">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="h6">
                                    {{$quiz->title}}
                                </div>
                                <div class="mb-4">
                                    {{$quiz->description}}
                                </div>
                                <div class="text-muted">
                                    @if( $quiz->time_is_limited==1 )
                                        {{__('text.Quiz time is limited')}}
                                        : {{$quiz->limitation_time}} {{__('text.minutes')}}
                                    @else
                                        {{__('text.Quiz time is not limited')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="d-flex flex-sm-column">
                                    <button class="btn btn-primary mb-2 mr-2" onclick="return quiz_information_edit();">{{__('text.Edit')}}</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="quiz_information_edit" style="display: none;">
                    <form method="post" action="">
                        @csrf

                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.Quiz Title')}}" value="{{$quiz->title}}">
                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="4" placeholder="{{__('text.Quiz Description')}}">{{$quiz->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="time_is_limited" name="time_is_limited"
                                               @if( $quiz->time_is_limited==1 )
                                               checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="time_is_limited">
                                            {{__('text.Quiz time is limited')}}
                                        </label>
                                    </div>
                                </div>

                                <div id="time_limited" class="form-group"
                                     @if($quiz->time_is_limited==0 )
                                     style="display: none"
                                    @endif
                                >
                                    <label for="time_limitation">{{__('text.time limitation')}}</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control {{ $errors->has('time_limitation') ? ' is-invalid' : '' }}"  id="time_limitation" name="time_limitation" value="{{$quiz->limitation_time}}">
                                        {{__('text.minutes')}}
                                    </div>
                                    @if ($errors->has('time_limitation'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('time_limitation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="d-flex flex-sm-column">
                                    <button type="submit" class="btn btn-primary mb-2 mr-2" onclick="return quiz_update('{{$course->id}}','{{$quiz->id}}');">
                                        {{__('text.Update')}}
                                    </button>
                                </div>
                            </div>
                        </div>


                    </form>
                    </div>

                </div>
                </div>
            </div>







            <div  class="card" style="background-color: #fafafa">
                <div class="card-header">
                    {{__('text.Quiz Questions')}}
                </div>
                <div  class="card-body">

                    <div id="quiz_questions">

                    @foreach($quiz->quiz_questions as $quiz_question)

                        <div id="quiz_question_{{$quiz_question->id}}">
                        <div id="quiz_question_show_{{$quiz_question->id}}">
                            <div class="row">
                            <div class="col-sm-10">
                                <div>
                            <div class="mb-2 mt-2">
                                {{$quiz_question->question}}
                            </div>
                            <div>
                                @if($quiz_question->true_answer==1)
                                    <i class="fas fa-circle icon_size_xs"></i>
                                @else
                                    <i class="far fa-circle icon_size_xs"></i>
                                @endif
                                {{$quiz_question->answer1}}
                            </div>
                            <div>
                                @if($quiz_question->true_answer==2)
                                    <i class="fas fa-circle icon_size_xs"></i>
                                @else
                                    <i class="far fa-circle icon_size_xs"></i>
                                @endif
                                {{$quiz_question->answer2}}
                            </div>
                            <div>
                                @if($quiz_question->true_answer==3)
                                    <i class="fas fa-circle icon_size_xs"></i>
                                @else
                                    <i class="far fa-circle icon_size_xs"></i>
                                @endif
                                {{$quiz_question->answer3}}
                            </div>
                            <div>
                                @if($quiz_question->true_answer==4)
                                    <i class="fas fa-circle icon_size_xs"></i>
                                @else
                                    <i class="far fa-circle icon_size_xs"></i>
                                @endif
                                {{$quiz_question->answer4}}
                            </div>
                        </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="d-flex flex-sm-column">
                                    <button class="btn btn-primary mb-2 mr-2" onclick="return quiz_question_edit({{$quiz_question->id}})">
                                        {{__('text.Edit')}}
                                    </button>
                                    <button class="btn btn-primary mb-2 mr-2" onclick="return quiz_question_delete('{{$course->id}}','{{$quiz_question->id}}')">{{__('text.Delete')}}</button>
                                </div>
                            </div>
                            </div>
                        </div>


                    <div id="quiz_question_edit_{{$quiz_question->id}}" style="display: none">
                    <form method="post" action="">
                        @csrf

                        <div class="row">
                            <div class="col-sm-10">

                                <div class="form-group">
                                    <input type="text" class="form-control text-small black_text"  id="question_{{$quiz_question->id}}" name="question_{{$quiz_question->id}}" placeholder="{{__('text.Question')}}" value="{{$quiz_question->question}}">

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer_{{$quiz_question->id}}" id="true_answer1_{{$quiz_question->id}}" value="1"
                                    @if($quiz_question->true_answer==1)
                                        checked
                                    @endif
                                    >
                                    <input type="text" class="form-control  text-small black_text"  id="answer1_{{$quiz_question->id}}" name="answer1_{{$quiz_question->id}}" placeholder="{{__('text.Answer 1')}}" value="{{$quiz_question->answer1}}">

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer_{{$quiz_question->id}}" id="true_answer2_{{$quiz_question->id}}" value="2"
                                           @if($quiz_question->true_answer==2)
                                           checked
                                        @endif
                                    >
                                    <input type="text" class="form-control  text-small black_text"  id="answer2_{{$quiz_question->id}}" name="answer2_{{$quiz_question->id}}" placeholder="{{__('text.Answer 2')}}" value="{{$quiz_question->answer2}}">

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer_{{$quiz_question->id}}" id="true_answer3_{{$quiz_question->id}}" value="3"
                                           @if($quiz_question->true_answer==3)
                                           checked
                                        @endif
                                    >
                                    <input type="text" class="form-control  text-small black_text"  id="answer3_{{$quiz_question->id}}" name="answer3_{{$quiz_question->id}}" placeholder="{{__('text.Answer 3')}}" value="{{$quiz_question->answer3}}">

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer_{{$quiz_question->id}}" id="true_answer4_{{$quiz_question->id}}" value="4"
                                           @if($quiz_question->true_answer==4)
                                           checked
                                        @endif
                                    >
                                    <input type="text" class="form-control  text-small black_text"  id="answer4_{{$quiz_question->id}}" name="answer4_{{$quiz_question->id}}" placeholder="{{__('text.Answer 4')}}" value="{{$quiz_question->answer4}}">

                                </div>

                            </div>
                            <div class="col-sm-2">

                                <div class="d-flex flex-sm-column">
                                    <button type="submit" class="btn btn-primary mb-2 mr-2" onclick="return update_quiz_question('{{$course->id}}','{{$quiz_question->id}}');">{{__('text.Update')}}</button>
                                </div>

                            </div>
                        </div>


                    </form>
                    </div>
                        </div>

                        <hr>
                        @endforeach

                    </div>

                </div>
            </div>








            <div  class="card" style="background-color: #fafafa">
                <div class="card-header">
                    {{__('text.Add New Question')}}
                </div>
                <div class="card-body">

                    <form method="post" action="">
                        @csrf

                        <div class="row">
                            <div id="add_new_question" class="col-sm-10">

                                <div class="form-group">
                                    <input type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }} text-small black_text"  id="question" name="question" placeholder="{{__('text.Question')}}" >
                                    @if ($errors->has('question'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer" id="true_answer1" value="1">
                                    <input type="text" class="form-control {{ $errors->has('answer1') ? ' is-invalid' : '' }} text-small black_text"  id="answer1" name="answer1" placeholder="{{__('text.Answer 1')}}" >
                                    @if ($errors->has('answer1'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer" id="true_answer2" value="2">
                                    <input type="text" class="form-control {{ $errors->has('answer2') ? ' is-invalid' : '' }} text-small black_text"  id="answer2" name="answer2" placeholder="{{__('text.Answer 2')}}" >
                                    @if ($errors->has('answer2'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer2') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer" id="true_answer3" value="3">
                                    <input type="text" class="form-control {{ $errors->has('answer3') ? ' is-invalid' : '' }} text-small black_text"  id="answer3" name="answer3" placeholder="{{__('text.Answer 3')}}" >
                                    @if ($errors->has('answer3'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer3') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="true_answer" id="true_answer4" value="4">
                                    <input type="text" class="form-control {{ $errors->has('answer4') ? ' is-invalid' : '' }} text-small black_text"  id="answer4" name="answer4" placeholder="{{__('text.Answer 4')}}" >
                                    @if ($errors->has('answer4'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer4') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-sm-2">

                                <div class="d-flex flex-sm-column">
                                    <button type="submit" class="btn btn-primary mb-2 mr-2" onclick="return add_quiz_question('{{$course->id}}','{{$quiz->id}}');">{{__('text.Add')}}</button>
                                </div>

                            </div>
                        </div>


                    </form>

                </div>
            </div>




            <div class="d-flex justify-content-center">
            <a class="btn btn-success col-sm-2" href="{{route('course.manage_course_content',['id'=>$course->id])}}">
                <i class="fas fa-check"></i>
                {{__('text.Done')}}
            </a>
            </div>

        </div>
    </div>

@endsection
