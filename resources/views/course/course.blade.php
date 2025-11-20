@extends('layouts.main')

@section('content')
    <div class="container " >
        <ul class="nav nav-tabs sticky-60px_top">
            <li class="nav-item"><a class="nav-link @yield('active_about_the_course')" href="{{route('course.about_the_course',['id'=>$course->id])}}" >{{__('text.about the course')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_course_content')" href="{{route('course.course_content',['id'=>$course->id])}}" >{{__('text.course content')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_resources')" href="{{route('course.resources',['id'=>$course->id])}}" >{{__('text.resources')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_qa')" href="{{route('course.qa',['id'=>$course->id])}}" >{{__('text.Q & A')}}</a> </li>
            @can('teacher_access',$course)
                <li class="nav-item"><a class="nav-link @yield('active_course_management')" href="{{route('course.course_management',['id'=>$course->id])}}" >{{__('text.course management')}}</a> </li>
            @endcan
        </ul>
        @yield('tab_content')
    </div>
@endsection
