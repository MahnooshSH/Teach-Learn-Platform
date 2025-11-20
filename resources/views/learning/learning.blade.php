@extends('layouts.main')
@section('active_learning')
    class="active"
@endsection
@section('content')
    <div class="container content-width-70" >
        <ul class="nav nav-tabs sticky-60px_top">
            <li class="nav-item"><a class="nav-link @yield('active_top_courses')" href="{{route('learning.top_courses')}}" >{{__('text.top courses')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_my_courses_as_student')" href="{{route('learning.my_courses_as_student')}}" >{{__('text.my courses (as student)')}}</a> </li>
        </ul>
        @yield('tab_content')
    </div>
@endsection
