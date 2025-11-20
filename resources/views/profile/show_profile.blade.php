<div class="card">

    <img  src="{{asset('images/blackboard.jpg')}}" width="100%" height="210px" alt="background_profile">
    <div class="profile-username h3 font-weight-bold text-center">{{$user->username}}</div>
    <img class="profile-image" src="{{asset('storage/profile_images/'.$user->profile_image)}}" width="150px" height="150px" alt="profile">

    <div class="card-body profile-body">
        <h4 class="card-title text-center">{{$user->first_name}} {{$user->last_name}}</h4>
        <pre class="text-center text-muted ">{{$user->bio}}</pre>


        <div id="follow">
            <div class="d-flex justify-content-center mt-3 mb-3">
                <div class="col-sm-auto">
                    <a href="#show_followers" data-toggle="modal">
                    {{$user->followers->count()}}
                    {{__('text.Followers')}}
                    </a>


                    <!-- followers Modal -->
                    <div class="modal fade" id="show_followers" tabindex="-1" role="dialog" aria-labelledby="show_followersTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="container">
                                        <h6 class="modal-title font-weight-bold" id="show_followersTitle">{{__('text.Followers')}}</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        @foreach($user->followers as $follower)
                                            <a href="{{route('profile.show_user',['user_id'=>$follower->id])}}">
                                                <div class="media">
                                                    <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$follower->profile_image)}}"
                                                         width="40px" height="40px" alt="student_profile">
                                                    <div class="media-body ml-3">
                                                        <div class="font-weight-bold">
                                                            {{$follower->username}}
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$follower->first_name}} {{$follower->last_name}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-sm-auto">
                    <a href="#show_following" data-toggle="modal">
                    {{$user->following->count()}}
                    {{__('text.Following')}}
                    </a>


                    <!-- followers Modal -->
                    <div class="modal fade" id="show_following" tabindex="-1" role="dialog" aria-labelledby="show_followingTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="container">
                                        <h6 class="modal-title font-weight-bold" id="show_followingTitle">{{__('text.Following')}}</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        @foreach($user->following as $following_user)
                                            <a href="{{route('profile.show_user',['user_id'=>$following_user->id])}}">
                                                <div class="media">
                                                    <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$following_user->profile_image)}}"
                                                         width="40px" height="40px" alt="student_profile">
                                                    <div class="media-body ml-3">
                                                        <div class="font-weight-bold">
                                                            {{$following_user->username}}
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$following_user->first_name}} {{$following_user->last_name}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            @if(Auth::user()->id != $user->id)

                <div class="d-flex justify-content-center mt-3 mb-3">
                    @if(Auth::user()->following()->where('following_id',$user->id)->exists())
                        <div style="width: 400px">
                            <button class="btn btn-outline-primary btn-block" onclick="return un_follow({{$user->id}});">
                                {{__('text.Following')}}
                            </button>
                        </div>
                    @else
                        <div style="width: 400px">
                            <button class="btn btn-primary btn-block" onclick="return follow({{$user->id}});">
                                {{__('text.Follow')}}
                            </button>
                        </div>
                    @endif

                </div>
            @endif
        </div>


        <nav>
            <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                    {{$user->posts->count()}} {{__('text.Posts')}}
                </a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#shared_files" role="tab" aria-controls="shared_files" aria-selected="false">
                    {{$user->shared_files->count()}} {{__('text.Shared files')}}
                </a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="questions" aria-selected="false">
                    {{$user->questions->count()}} {{__('text.Questions')}}
                </a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">
                    {{$user->courses->count()}} {{__('text.Courses')}}
                </a>

            </div>
        </nav>


        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="nav-home-tab">

                @foreach($user->posts as $post)
                    @include('posts.show_post')
                @endforeach

            </div>
            <div class="tab-pane fade" id="shared_files" role="tabpanel" aria-labelledby="nav-profile-tab">

                @foreach($user->shared_files as $shared_file)
                    @include('library.show_shared_file')
                @endforeach

            </div>
            <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="nav-contact-tab">

                @foreach($user->questions as $question)
                    @include('question_answer.show_question')
                @endforeach

            </div>
            <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="nav-contact-tab">

                <div class="row">
                    @foreach($user->courses as $course)
                        @include('course.show_courses')
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>
