@extends('course.course_content')


@section('show_course_content')

    @can('teacher_access',$course)

        <div class="card-body">
            <div class="row">
                <div class="col-sm-9">


                    <div class="h4 mb-1">
                        {{$quiz->title}}
                    </div>


                </div>

                <div class="col-sm-3">

                    <a class="btn btn-success" href="{{route('course.quiz_results',['course_id'=>$course->id,'quiz_id'=>$quiz->id])}}">
                        {{__('text.Show Quiz Results')}}
                    </a>

                </div>
            </div>

            <div class="mt-2 mb-1">
                {{$quiz->description}}
            </div>
            <hr>
            <div class="mb-1">
                {{__('text.Number of questions:')}}
                {{$quiz->quiz_questions->count()}}
            </div>
            <div class="mb-1">
                @if( $quiz->time_is_limited==1 )
                    {{__('text.Time limit')}}
                    : {{$quiz->limitation_time}} {{__('text.minutes')}}
                @endif
            </div>


            <div class="row mt-3">
                <div class="col-sm-5">
                    <hr>
                </div>
                <div class="col-sm-2 text-center">
                    {{__('text.Questions')}}
                </div>
                <div class="col-sm-5">
                    <hr>
                </div>
            </div>

            @foreach($quiz->quiz_questions as $quiz_question)

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

                <hr>
            @endforeach
        </div>




    @elsecan('student_access',$course)
        <div class="card-body">

            <div class="h4 mb-1">
                {{$quiz->title}}
            </div>
            <div class="mb-1">
                {{$quiz->description}}
            </div>
            <hr>
            <div class="mb-1 h6" style="color: darkred">
                {{__('text.Number of questions:')}}
                {{$quiz->quiz_questions->count()}}
            </div>
            <div class="mb-1 h6" style="color:red;">
                @if( $quiz->time_is_limited==1 )
                    {{__('text.Time limit')}}
                    : {{$quiz->limitation_time}} {{__('text.minutes')}}
                @endif
            </div>
            <hr>
            @if($quiz->quiz_answers()->where('student_id',Auth::user()->id)->doesntExist())

                <noscript>
                    <div class="alert alert-danger h6 sticky-side-menu-top">
                        {{__('text.Enable your javascript')}}
                    </div>
                </noscript>

            <div class="d-flex justify-content-center">

                <a class="btn btn-success" href="{{route('course.take_quiz',['course_id'=>$course->id,'quiz_id'=>$quiz->id])}}">{{__('text.Start the quiz')}}</a>


            </div>
            @elseif(is_null($quiz->quiz_answers()->where('student_id',Auth::user()->id)->first()->result))

                <noscript>
                    <div class="alert alert-danger h6 sticky-side-menu-top">
                        {{__('text.Enable your javascript')}}
                    </div>
                </noscript>

                <div class="d-flex justify-content-center">

                    <a class="btn btn-success" href="{{route('course.take_quiz',['course_id'=>$course->id,'quiz_id'=>$quiz->id])}}">{{__('text.Continue the quiz')}}</a>

                </div>
            @else
                @php
                $quiz_answer=$quiz->quiz_answers()->where('student_id',Auth::user()->id)->first();
                $answer=$quiz_answer->answer;
                $answer_array=unserialize($answer);
                @endphp


                <div class="card bg-light text-center">

                    <div class="card-header h5">
                        {{__('text.Quiz Result')}}
                    </div>
                    <div class="card-body h6">
                        <div>
                            <span class="text-muted">{{__('text.Quiz score')}} :</span>
                            {{$quiz_answer->result}}
                            <span class="text-muted">/100</span>
                        </div>

                        <div>
                            <span class="text-muted">{{__('text.Correct answers')}} :</span>
                            {{$quiz_answer->true_count}}
                        </div>

                        <div>
                            <span class="text-muted">{{__('text.Incorrect answers')}} :</span>
                            {{$quiz_answer->wrong_count}}
                        </div>

                        <div>
                            <span class="text-muted">{{__('text.Unanswered')}} :</span>
                            {{$quiz_answer->unanswered_count}}
                        </div>
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-sm-5">
                        <hr>
                    </div>
                    <div class="col-sm-2 text-center">
                        {{__('text.Questions')}}
                    </div>
                    <div class="col-sm-5">
                        <hr>
                    </div>
                </div>


                @foreach($quiz->quiz_questions as $quiz_question)

                    <div class="mb-2 mt-2">
                        {{$quiz_question->question}}
                    </div>
                    @php
                        $student_answer=0;
                    @endphp
                    @isset($answer_array[$quiz_question->id])
                        @php
                            $student_answer=$answer_array[$quiz_question->id];
                        @endphp
                    @endisset
                    <div>
                        @if($quiz_question->true_answer==1 and $student_answer==1)
                            <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                        @elseif($quiz_question->true_answer==1)
                            <i class="fas fa-circle icon_size_xs"></i>
                        @elseif($student_answer==1)
                            <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                        @else
                            <i class="far fa-circle icon_size_xs"></i>
                        @endif
                        {{$quiz_question->answer1}}
                    </div>
                    <div>
                        @if($quiz_question->true_answer==2 and $student_answer==2)
                            <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                        @elseif($quiz_question->true_answer==2)
                            <i class="fas fa-circle icon_size_xs"></i>
                        @elseif($student_answer==2)
                            <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                        @else
                            <i class="far fa-circle icon_size_xs"></i>
                        @endif
                        {{$quiz_question->answer2}}
                    </div>
                    <div>
                        @if($quiz_question->true_answer==3 and $student_answer==3)
                            <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                        @elseif($quiz_question->true_answer==3)
                            <i class="fas fa-circle icon_size_xs"></i>
                        @elseif($student_answer==3)
                            <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                        @else
                            <i class="far fa-circle icon_size_xs"></i>
                        @endif
                        {{$quiz_question->answer3}}
                    </div>
                    <div>
                        @if($quiz_question->true_answer==4 and $student_answer==4)
                            <i class="fas fa-circle icon_size_xs " style="color: green"></i>
                        @elseif($quiz_question->true_answer==4)
                            <i class="fas fa-circle icon_size_xs"></i>
                        @elseif($student_answer==4)
                            <i class="fas fa-circle icon_size_xs" style="color: red"></i>
                        @else
                            <i class="far fa-circle icon_size_xs"></i>
                        @endif
                        {{$quiz_question->answer4}}
                    </div>

                    <hr>
                @endforeach
            @endif
        </div>
    @endcan



    <div class="mb-5 d-flex justify-content-between">

        @if($this_edu_session->lesson->edu_sessions()->where('created_at','<',$this_edu_session->created_at)->exists())

            @php
                $previous_session=$this_edu_session->lesson->edu_sessions()
                ->where('created_at','<',$this_edu_session->created_at)
                ->orderBy('created_at','desc')->first();
            @endphp
            @if($previous_session->session_type=='tutorial_video')
                <a class="btn btn-outline-secondary" style="width:150px;"
                   href="{{route('course.show_tutorial_video',['course_id'=>$course->id,'edu_session'=>$previous_session->id,'tutorial_video_id'=>$previous_session->tutorial_video->id])}}" role="button">{{__('text.previous')}}</a>
            @endif
            @if($previous_session->session_type=='quiz')
                <a class="btn btn-outline-secondary" style="width:150px;"
                   href="{{route('course.show_quiz',['course_id'=>$course->id,'edu_session'=>$previous_session->id,'quiz_id'=>$previous_session->quiz->id])}}" role="button">{{__('text.previous')}}</a>
            @endif
        @else
            @php
                $this_lesson=$this_edu_session->lesson;
            @endphp
            <a class="btn btn-outline-secondary" style="width:150px;"
               href="{{route('course.show_lesson',['course_id'=>$course->id,'lesson_id'=>$this_lesson->id])}}" role="button">{{__('text.previous')}}</a>
        @endif
        @if($this_edu_session->lesson->edu_sessions()->where('created_at','>',$this_edu_session->created_at)->exists())

            @php
                $next_session=$this_edu_session->lesson->edu_sessions()
                ->where('created_at','>',$this_edu_session->created_at)->first();
            @endphp
            @if($next_session->session_type=='tutorial_video')
                <a class="btn btn-outline-secondary" style="width:150px;"
                   href="{{route('course.show_tutorial_video',['course_id'=>$course->id,'edu_session_id'=>$next_session->id,'tutorial_video_id'=>$next_session->tutorial_video->id])}}" role="button">{{__('text.next')}}</a>
            @endif
            @if($next_session->session_type=='quiz')
                <a class="btn btn-outline-secondary" style="width:150px;"
                   href="{{route('course.show_quiz',['course_id'=>$course->id,'edu_session_id'=>$next_session->id,'quiz_id'=>$next_session->quiz->id])}}" role="button">{{__('text.next')}}</a>
            @endif

        @elseif($this_edu_session->lesson->where('lesson_number','>',$this_edu_session->lesson->lesson_number)->exists())
            @php
                $next_lesson=$this_edu_session->lesson
                ->where('lesson_number','>',$this_edu_session->lesson->lesson_number)->first();
            @endphp
            <a class="btn btn-outline-secondary" style="width:150px;"
               href="{{route('course.show_lesson',['course_id'=>$course->id,'lesson_id'=>$next_lesson->id])}}" role="button">{{__('text.next')}}</a>
        @endif

    </div>



@endsection
