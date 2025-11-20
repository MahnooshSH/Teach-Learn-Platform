@extends('course.course')
@section('active_course_content')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="course_content">

            <div class="row flex-md-row text-justify">
                <div class="col-md-3">
                    <div class="card course_content_scroll sticky-side-menu-top">

                        <div class="course_content_list">




                            <div class="list-group">
                                @foreach($course->lessons()->orderBy('lesson_number')->get() as $lesson_item)
                                    <a href="{{route('course.show_lesson',['course_id'=>$course->id,'lesson_id'=>$lesson_item->id])}}"
                                       class="list-group-item list-group-item-action lessons_list h6

                                       @isset($lesson)
                                       @if($lesson->id==$lesson_item->id)
                                           course_content_active  @endif
                                       @endisset
                                           ">

                                        {{$lesson_item->lesson_number}}.{{$lesson_item->title}}
                                    </a>
                                    @foreach($lesson_item->edu_sessions()->orderBy('created_at')->get() as $edu_session)

                                        @if($edu_session->session_type=='tutorial_video')
                                            <a href="{{route('course.show_tutorial_video',['course_id'=>$course->id,'edu_session_id'=>$edu_session->id,'tutorial_video_id'=>$edu_session->tutorial_video->id])}}"
                                               class="list-group-item list-group-item-action edu_sessions_list
                                               @isset($this_edu_session)
                                               @if($this_edu_session->id==$edu_session->id)
                                                   course_content_active  @endif
                                               @endisset
                                                   ">
                                                <div>
                                                    <i class="fas fa-film icon_size_s mr-1"></i>
                                                    {{$edu_session->tutorial_video->title}}
                                                </div>
                                            </a>
                                        @elseif($edu_session->session_type=='quiz')
                                            <a href="{{route('course.show_quiz',['course_id'=>$course->id,'edu_session_id'=>$edu_session->id,'quiz_id'=>$edu_session->quiz->id])}}"
                                               class="list-group-item list-group-item-action edu_sessions_list
                                               @isset($this_edu_session)
                                               @if($this_edu_session->id==$edu_session->id)
                                                   course_content_active  @endif
                                               @endisset">
                                                <div>
                                                    <i class="far fa-question-circle icon_size_s mr-1"></i>
                                                    {{$edu_session->quiz->title}}
                                                </div>
                                            </a>
                                        @endif

                                    @endforeach
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">

                            @can('teacher_access', $course)
                                @yield('show_course_content',view('course.default_content'))
                            @elsecan('student_access', $course)
                                @yield('show_course_content',view('course.default_content'))
                            @else
                                <div class="text-muted h4 text-center mt-5 mb-5">
                                    {{__('text.You must first register to access course content')}}
                                </div>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

