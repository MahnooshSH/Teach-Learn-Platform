@extends('learning.learning')
@section('active_my_courses_as_student')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="my_courses_as_student">

            <div class="row">


                @foreach($courses as $course)
                    @include('course.show_courses')
                @endforeach


            </div>

        </div>
    </div>
@endsection
