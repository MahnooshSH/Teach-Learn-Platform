@extends('posts.posts')
@section('active_following_posts')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
            <div class="tab-pane active " id="following_posts">


                @foreach($posts as $post)
                    @include('posts.show_post')
                @endforeach


            </div>
    </div>
@endsection
