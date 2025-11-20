@extends('profile.profile')
@section('active_user_profile')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
            <div class="tab-pane active" id="user_info">

                @include('profile.show_profile')

            </div>
    </div>
@endsection
