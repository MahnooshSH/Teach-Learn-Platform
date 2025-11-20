@extends('learning.learning')
@section('active_top_courses')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="top_courses">

            <div class="row">



            @foreach($courses as $course)
                @include('course.show_courses')
            @endforeach








                </div>



        </div>
    </div>
@endsection
