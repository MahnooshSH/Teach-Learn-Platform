@extends('search.search')
@section('active_users')
    active
@endsection
@section('tab_content')

    @empty($user)

        <div class="d-flex justify-content-center mt-5 mb-3">
            <img class="img-fluid" src="{{asset('images/search_show.png')}}" width="200px"  alt="">
        </div>

    @endempty

    <div class="d-flex justify-content-center mt-3">
        <div class="col-lg-6">

            <form method="get" action="{{route('search.search_user')}}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{__('text.Search users ...')}}" id="search_user" name="search_user" value="@isset($user){{$user->username}}@endisset" aria-label="Search users" aria-describedby="user_search" autocomplete="off" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" id="tag_search"><i class="fas fa-search icon_size_s"></i></button>
                    </div>
                </div>
            </form>


            <div id="live_search_user" class="bg-white"></div>

        </div>

    </div>


    <div class="tab-content">
        <div class="tab-pane active" id="users_search">
            @isset($user)

                <div class="container col-lg-11">
                    @include('profile.show_profile')
                </div>

            @endisset
            @isset($no_find)

                <div class="d-flex justify-content-center text-muted h3">
                    {{__('text.No results found')}}
                </div>

            @endisset


        </div>
    </div>
@endsection
