@extends('layouts.main')
@section('active_teaching')
    class="active"
@endsection
@section('content')
    <div class="container content-width-70" >
        <ul class="nav nav-tabs sticky-60px_top">
            <li class="nav-item"><a class="nav-link @yield('active_my_courses_as_teacher')" href="{{route('teaching.my_courses_as_teacher')}}" >{{__('text.my courses (as teacher)')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_create_new_course')" href="{{route('teaching.create_new_course')}}" ><i class="fas fa-plus"></i> {{__('text.create a new course')}}</a> </li>
        </ul>
        @yield('tab_content')
    </div>
@endsection
