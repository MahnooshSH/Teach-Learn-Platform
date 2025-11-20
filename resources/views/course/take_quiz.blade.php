@extends('course.course_content')


@section('show_course_content')


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

        @if($quiz->time_is_limited==1)

            @php

                $quiz_answer=$quiz->quiz_answers()->where('student_id',Auth::user()->id)->first();
                $start_time=\Carbon\Carbon::parse($quiz_answer->created_at);
                $now=\Carbon\Carbon::now();
                $time_diff=$start_time->diffInSeconds($now);

                $limit_time=($quiz->limitation_time)*60;
                $time=$limit_time-$time_diff;

                $hour=floor($time/3600);
                $minute=floor($time/60);
                $second=$time%60;
                        echo '<script type="text/javascript">
                            time = '.$time.';

                            hour=Math.floor(time / 3600);
                            minute=Math.floor(time / 60);
                            second=time % 60;
                            timer = setInterval(function () {
                                    var element = document.getElementById("status");
                                    minute=Math.floor(time / 60);
                                    second=time % 60;
                                    element.innerHTML = "<b>"+hour+"</b>:<b>"+minute+"</b>:<b>"+second+"</b>";
                                    if(time < 1){
                                        clearInterval(timer);
                                        document.getElementById("quiz_form").submit();
                                    }
                                    time--;
                                }, 1000)
                        </script>' ;
            @endphp




            <div class="sticky-side-menu-top">
                <div class="d-flex justify-content-center alert alert-warning h5">
                    <div class="col-sm-auto">
                        {{__('text.Time Remaining')}} :
                    </div>
                    <div id="status" class="col-sm-auto">
                        <b>{{$hour}}</b>:<b>{{$minute}}</b>:<b>{{$second}}</b>
                    </div>
                </div>
            </div>


            <noscript>
                <div class="alert alert-danger h6 sticky-side-menu-top">
                    {{__('text.Enable your javascript')}}
                </div>
            </noscript>


            <hr>

        @endif


            @php
            echo '
            <script type="text/javascript">
                save_timer = setInterval(function () {

                    $.ajax(
                        {
                            type:"POST",
                            url:"/user_panel/course/'.$course->id.'/save_per_minute/'.$quiz->id.'",
                            data:$("#quiz_form").serialize(),

                        });


                    return false;


                }, 10000)

            </script>
            ';
            @endphp



            @php
                $quiz_answer=$quiz->quiz_answers()->where('student_id',Auth::user()->id)->first();
                $answer=$quiz_answer->answer;
                $answer_array=unserialize($answer);
            @endphp

        <form method="post" id="quiz_form" action="{{route('course.quiz',['course_id'=>$course->id,'quiz_id'=>$quiz->id])}}">
            @csrf

            @foreach($quiz->quiz_questions as $question)
                @php
                    $student_answer=0;
                @endphp
                @isset($answer_array[$question->id])
                    @php
                        $student_answer=$answer_array[$question->id];
                    @endphp
                @endisset
                <div class="mb-2 mt-2">
                    {{$question->question}}
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->id}}_1" value="1"
                        @if($student_answer==1)
                            checked
                        @endif
                        >
                        <label class="form-check-label" for="{{$question->id}}_1">{{$question->answer1}}</label>
                    </div>
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->id}}_2" value="2"
                               @if($student_answer==2)
                               checked
                            @endif
                        >
                        <label class="form-check-label" for="{{$question->id}}_2">{{$question->answer2}}</label>
                    </div>
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->id}}_3" value="3"
                               @if($student_answer==3)
                               checked
                            @endif
                        >
                        <label class="form-check-label" for="{{$question->id}}_3">{{$question->answer3}}</label>
                    </div>
                </div>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{$question->id}}" id="{{$question->id}}_4" value="4"
                               @if($student_answer==4)
                               checked
                            @endif
                        >
                        <label class="form-check-label" for="{{$question->id}}_4">{{$question->answer4}}</label>
                    </div>
                </div>

                <hr>
            @endforeach
            <button type="submit" class="btn btn-success">{{__('text.Submit')}}</button>
        </form>

    </div>



@endsection
