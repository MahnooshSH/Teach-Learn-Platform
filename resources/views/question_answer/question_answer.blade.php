@extends('layouts.main')
@section('active_question_answer')
    class="active"
@endsection
@section('content')
    <div class="container content-width-70" >
        <ul class="nav nav-tabs sticky-60px_top">
            <li class="nav-item"><a class="nav-link @yield('active_following_questions')" href="{{route('question_answer.following_questions')}}" >{{__('text.following questions')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_recent_questions')" href="{{route('question_answer.recent_questions')}}" >{{__('text.recent questions')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_top_questions')" href="{{route('question_answer.top_questions')}}" >{{__('text.top questions')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_my_questions')" href="{{route('question_answer.my_questions')}}" >{{__('text.my questions')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_ask_question')" href="{{route('question_answer.ask_question')}}" ><i class="fas fa-question-circle"></i> {{__('text.Ask a question')}}</a> </li>
        </ul>
        @yield('tab_content')
    </div>
@endsection
