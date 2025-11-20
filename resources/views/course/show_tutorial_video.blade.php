@extends('course.course_content')


@section('show_course_content')
    <div class="mb-3 " >

        <h4>
            <div>
                {{$tutorial_video->title}}
            </div>
        </h4>

    </div>
    <div class="mb-4">
        <video width="800px" class="rounded img-fluid"  controls>
            <source src="{{asset('storage/'.$tutorial_video->tutorial_video)}}" type="video/mp4">
        </video>

    </div>


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
