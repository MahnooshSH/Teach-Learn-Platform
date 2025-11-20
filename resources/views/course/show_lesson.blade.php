@extends('course.course_content')


@section('show_course_content')

    <div class="card-body">
        <div class="h4">
            {{$lesson->lesson_number}}.{{$lesson->title}}
        </div>
        <pre class="mt-3 mb-5">{{$lesson->description}}</pre>



    <div class="mb-5 d-flex justify-content-between">

        @if($course->lessons()->where('lesson_number','<',$lesson->lesson_number)->exists())
            @php
                $previous_lesson=$course->lessons()->where('lesson_number','<',$lesson->lesson_number)
                ->orderBy('lesson_number','desc')->first();
            @endphp


            @if($previous_lesson->edu_sessions()->exists())

                @php
                    $previous_session=$previous_lesson->edu_sessions()
                    ->orderBy('created_at','desc')->first();
                @endphp
                @if($previous_session->session_type=='tutorial_video')
                    <a class="btn btn-outline-secondary" style="width:150px;"
                       href="{{route('course.show_tutorial_video',['course_id'=>$course->id,'edu_session_id'=>$previous_session->id,'tutorial_video_id'=>$previous_session->tutorial_video->id])}}" role="button">{{__('text.previous')}}</a>
                @endif
                @if($previous_session->session_type=='quiz')
                    <a class="btn btn-outline-secondary" style="width:150px;"
                       href="{{route('course.show_quiz',['course_id'=>$course->id,'edu_session_id'=>$previous_session->id,'quiz_id'=>$previous_session->quiz->id])}}" role="button">{{__('text.previous')}}</a>
                @endif
            @else
                <a class="btn btn-outline-secondary" style="width:150px;"
                   href="{{route('course.show_lesson',['course_id'=>$course->id,'lesson_id'=>$previous_lesson->id])}}" role="button">{{__('text.previous')}}</a>
            @endif


        @endif


        @if($lesson->edu_sessions()->exists())

            @php
                $next_session=$lesson->edu_sessions()->first();
            @endphp
            @if($next_session->session_type=='tutorial_video')
                <a class="btn btn-outline-secondary" style="width:150px;"
                   href="{{route('course.show_tutorial_video',['course_id'=>$course->id,'edu_session_id'=>$next_session->id,'tutorial_video_id'=>$next_session->tutorial_video->id])}}" role="button">{{__('text.next')}}</a>
            @endif
            @if($next_session->session_type=='quiz')
                <a class="btn btn-outline-secondary" style="width:150px;"
                   href="{{route('course.show_quiz',['course_id'=>$course->id,'edu_session_id'=>$next_session->id,'quiz_id'=>$next_session->quiz->id])}}" role="button">{{__('text.next')}}</a>
            @endif

        @elseif($course->lessons()->where('lesson_number','>',$lesson->lesson_number)->exists())
            @php
                $next_lesson=$course->lessons()->where('lesson_number','>',$lesson->lesson_number)
                ->orderBy('lesson_number')
                ->first();
            @endphp
            <a class="btn btn-outline-secondary" style="width:150px;"
               href="{{route('course.show_lesson',['course_id'=>$course->id,'lesson_id'=>$next_lesson->id])}}" role="button">{{__('text.next')}}</a>
        @endif

    </div>


    </div>
@endsection
