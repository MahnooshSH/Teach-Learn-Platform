@extends('layouts.main')
@section('active_profile')
    class="active"
@endsection
@section('content')
    <div class="container content-width-70" >
        <ul class="nav nav-tabs sticky-60px_top">

            <li class="nav-item"><a class="nav-link @yield('active_user_profile')" href="{{route('profile.user_profile')}}" >{{__('text.user profile')}}</a> </li>
            <li class="nav-item"><a class="nav-link @yield('active_edit_profile')" href="{{route('profile.edit_profile')}}" >{{__('text.edit profile')}}</a> </li>

        </ul>
        @yield('tab_content')
    </div>
@endsection
