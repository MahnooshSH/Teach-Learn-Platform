@extends('course.course_management.course_management')

@section('active_manage_course_content')
    active
@endsection

@section('manage_course')

    <div class="card">
        <div class="card-body">

    <table class="table table-bordered" style="font-size: 0.95rem;">
        <thead>
        <tr bgcolor="#f5f5f5">
            <th scope="col" colspan="2" width="200">{{__('text.Lessons')}}</th>
            <th scope="col">{{__('text.Course Sessions')}}</th>
            <th scope="col" width="180"></th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td colspan="4">
                <a href="{{route('course.create_new_lesson',['id'=>$course->id])}}" class="btn btn-primary btn-sm btn-block">
                    {{__('text.Create New Lesson')}}
                </a>
            </td>

        </tr>

        @foreach($course->lessons()->orderBy('lesson_number','asc')->get() as $lesson)



            <tr bgcolor="#f5f5f5">
                <td rowspan="{{$lesson->edu_sessions()->count()+1}}" align="center" width="40">{{$lesson->lesson_number}}</td>
                <td rowspan="{{$lesson->edu_sessions()->count()+1}}" align="center" width="160">
                    <div>{{$lesson->title}}</div>
                </td>
                <td>
                    <a href="{{route('course.upload_tutorial_video',['course_id'=>$course->id,'lesson_id'=>$lesson->id])}}" class="btn btn-primary btn-sm mr-3 mb-1">
                        {{__('text.Upload Tutorial Video')}}
                    </a>
                    <a href="{{route('course.create_new_quiz',['course_id'=>$course->id,'lesson_id'=>$lesson->id])}}" class="btn btn-primary btn-sm mr-3 mb-1">
                        {{__('text.Make Quiz')}}
                    </a>
                </td>
                <td>

                    <a href="{{route('course.edit_lesson',['course_id'=>$course->id,'lesson_id'=>$lesson->id])}}" class="btn btn-primary btn-sm mr-2 mb-1">
                        {{__('text.Edit')}}
                    </a>
                    <a href="{{route('course.delete_lesson',['course_id'=>$course->id,'lesson_id'=>$lesson->id])}}" class="btn btn-primary btn-sm mb-1">
                        {{__('text.Delete')}}
                    </a>
                </td>
            </tr>

            @foreach($lesson->edu_sessions()->orderBy('created_at','asc')->get() as $edu_session)

                <tr>
                    <td>
                        @if($edu_session->session_type=='tutorial_video')
                            <div>
                                <i class="fas fa-film icon_size_s mr-1"></i>
                                {{$edu_session->tutorial_video->title}}
                            </div>
                        @elseif($edu_session->session_type=='quiz')
                            <div>
                                <i class="far fa-question-circle icon_size_s mr-1"></i>
                                {{$edu_session->quiz->title}}
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($edu_session->session_type=='tutorial_video')

                            <a href="{{route('course.edit_tutorial_video',['course_id'=>$course->id,'tutorial_video_id'=>$edu_session->tutorial_video->id])}}" class="btn btn-success btn-sm mr-2 mb-1">
                                {{__('text.Edit')}}
                            </a>
                            <a href="{{route('course.delete_tutorial_video',['course_id'=>$course->id,'tutorial_video_id'=>$edu_session->tutorial_video->id])}}" class="btn btn-success btn-sm mb-1">
                                {{__('text.Delete')}}
                            </a>
                        @elseif($edu_session->session_type=='quiz')

                            <a href="{{route('course.make_quiz',['course_id'=>$course->id,'quiz_id'=>$edu_session->quiz->id])}}"
                               class="btn btn-success btn-sm mr-2 mb-1">
                                {{__('text.Edit')}}
                            </a>
                            <a href="{{route('course.delete_quiz',['course_id'=>$course->id,'quiz_id'=>$edu_session->quiz->id])}}" class="btn btn-success btn-sm mb-1">
                                {{__('text.Delete')}}
                            </a>
                        @endif

                    </td>
                </tr>


            @endforeach



            <tr>
                <td colspan="4">

                </td>

            </tr>

        @endforeach





        </tbody>
    </table>


        </div>
    </div>
@endsection
