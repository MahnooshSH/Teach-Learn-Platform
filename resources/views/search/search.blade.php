@extends('layouts.main')
@section('active_search')
    class="active"
@endsection
@section('content')
    <div class="container" >
        <ul class="nav nav-tabs sticky-60px_top">
            <li class="nav-item"><a class="nav-link @yield('active_courses')" href="{{route('search.courses_search')}}" >{{__('text.Courses')}}<i class="fas fa-search ml-1"></i></a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_posts')" href="{{route('search.posts_search')}}" >{{__('text.Posts')}}<i class="fas fa-search ml-1"></i></a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_library')" href="{{route('search.library_search')}}" >{{__('text.Library')}}<i class="fas fa-search ml-1"></i></a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_qa')" href="{{route('search.qa_search')}}" >{{__('text.Question & Answer')}}<i class="fas fa-search ml-1"></i></a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_users')" href="{{route('search.users_search')}}" >{{__('text.Users')}}<i class="fas fa-search ml-1"></i></a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_tags')" href="{{route('search.tags_search')}}" >{{__('text.Tags')}}<i class="fas fa-search ml-1"></i></a> </li>
        </ul>
        @yield('tab_content')
    </div>
@endsection
