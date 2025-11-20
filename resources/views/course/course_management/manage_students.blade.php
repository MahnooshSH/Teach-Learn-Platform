@extends('course.course_management.course_management')

@section('active_manage_students')
    active
@endsection

@section('manage_course')

    <div class="card" style="background-color: whitesmoke">
        <div class="card-body">

            <div class="text-center font-weight-bold mb-3">
                {{__('text.Students Count :')}} {{$course->students->count()}}
            </div>
            @foreach($course->students as $student)
                <div class="card card_width_center">
                    <div class="card-body">

                        <a href="{{route('profile.show_user',['user_id'=>$student->id])}}">
                        <div class="media">
                            <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$student->profile_image)}}"
                                 width="50px" height="50px" alt="student_profile">
                            <div class="media-body ml-3">
                                <div class="font-weight-bold">
                                    {{$student->username}}
                                </div>
                                <div class="text-muted">
                                    {{$student->first_name}} {{$student->last_name}}
                                </div>
                            </div>
                        </div>
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
