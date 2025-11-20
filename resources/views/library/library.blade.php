@extends('layouts.main')
@section('active_library')
    class="active"
@endsection
@section('content')
    <div class="container content-width-70" >
        <ul class="nav nav-tabs sticky-60px_top">
            <li class="nav-item"><a class="nav-link @yield('active_following_shared_files')" href="{{route('library.following_shared_files')}}" >{{__('text.following shared files')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_top_shared_files')" href="{{route('library.top_shared_files')}}" >{{__('text.top shared files')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_my_shared_files')" href="{{route('library.my_shared_files')}}" >{{__('text.my shared files')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_share_file')" href="{{route('library.share_file')}}" ><i class="fas fa-share-alt"></i> {{__('text.Share file')}}</a> </li>
        </ul>
        @yield('tab_content')
    </div>
@endsection
