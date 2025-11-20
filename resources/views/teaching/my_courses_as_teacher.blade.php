@extends('teaching.teaching')
@section('active_my_courses_as_teacher')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="my_courses_as_teacher">


            <div class="row">


                @foreach($courses as $course)
                    @include('course.show_courses')
                @endforeach


            </div>


        </div>
    </div>
@endsection
