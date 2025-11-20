@extends('layouts.main')
@section('active_posts')
    class="active"
@endsection
@section('content')
    <div class="container content-width-70" >
        <ul class="nav nav-tabs sticky-60px_top">
            <li class="nav-item"><a class="nav-link @yield('active_following_posts')" href="{{route('posts.following_posts')}}" >{{__('text.following posts')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_my_posts')" href="{{route('posts.my_posts')}}" >{{__('text.my posts')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_add_new_post')" href="{{route('posts.add_new_post')}}" ><i class="fas fa-plus"></i>  {{__('text.Add new post')}} </a> </li>

        </ul>
        @yield('tab_content')
    </div>

@endsection
