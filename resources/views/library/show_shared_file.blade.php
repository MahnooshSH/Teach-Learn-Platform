<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <div class="media mr-auto p-0" style="width: 300px">
            <a href="{{route('profile.show_user',['user_id'=>$shared_file->user->id])}}">
                <img class="rounded-circle mr-2" src="{{asset('storage/profile_images/'.$shared_file->user->profile_image)}}" width="38px" height="38px" alt="profile">
            </a>
            <div class="media-body">
                <div class="mt-0 font-weight-bold"><a href="{{route('profile.show_user',['user_id'=>$shared_file->user->id])}}">{{$shared_file->user->username}}</a></div>
                <div class="text-muted text-x-small">{{$shared_file->user->first_name}} {{$shared_file->user->last_name}}</div>
            </div>
        </div>
        <div class="text-muted p-0 mr-4">
            {{ \Carbon\Carbon::parse($shared_file->created_at)->format('F j, Y, g:i a')}}
        </div>


        <div class="dropdown p-0 ">
            <a href="#"  id="menu" data-toggle="dropdown" >
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu">
                @can('update', $shared_file)
                    <a class="dropdown-item" href="{{route('library.edit_shared_file',['id'=>$shared_file->id])}}">{{__('text.Edit')}}</a>
                @endcan
                @can('delete', $shared_file)
                    <a class="dropdown-item" href="{{route('library.delete_shared_file',['id'=>$shared_file->id])}}">{{__('text.Delete')}}</a>
                @endcan
                @can('report', $shared_file)
                    <a class="dropdown-item" href="#">{{__('text.Report')}}</a>
                @endcan

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-title font-weight-bold">
            {{$shared_file->title}}
            <span class="badge badge-pill badge-warning font-weight-bold ml-2" style="font-size: 0.8rem">{{$shared_file->file_type}}</span>
        </div>
        <pre>{{$shared_file->caption}}</pre>
        <div style="font-size: 1.1rem">
            @foreach($shared_file->tags as $tag)
                <a href="{{route('tag.show_tag',['tag_id'=>$tag->id])}}" class="badge badge-pill badge-secondary">{{$tag->name}}</a>
            @endforeach
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">



        <div id="shared_file_vote{{$shared_file->id}}">
            <div class="row">
                <div class="col-sm-auto">
                    <form method="post">
                        @csrf
                        <button class="btn_text" onclick="return shared_file_up_vote({{$shared_file->id}});">
                            <i class="fas fa-chevron-up icon_size_m mr-1 {{Auth::user()->shared_file_votes()->where('shared_file_id',$shared_file->id)->where('vote',1)->exists() ? 'up_vote' : ''}}"></i>
                        </button>
                        <a href="#show_file_up_votes{{$shared_file->id}}" data-toggle="modal"><span >{{$shared_file->shared_file_votes()->where('vote',1)->count()}}</span></a>
                    </form>


                    <!-- upvotes  Modal -->
                    <div class="modal fade" id="show_file_up_votes{{$shared_file->id}}" tabindex="-1" role="dialog" aria-labelledby="show_file_up_votes{{$shared_file->id}}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="container">
                                        <h6 class="modal-title font-weight-bold" id="show_file_up_votes{{$shared_file->id}}Title">{{__('text.Upvotes')}}</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        @foreach($shared_file->shared_file_votes()->where('vote',1)->get() as $file_up_vote)
                                            <a href="{{route('profile.show_user',['user_id'=>$file_up_vote->user->id])}}">
                                                <div class="media">
                                                    <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$file_up_vote->user->profile_image)}}"
                                                         width="40px" height="40px" alt="student_profile">
                                                    <div class="media-body ml-3">
                                                        <div class="font-weight-bold">
                                                            {{$file_up_vote->user->username}}
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$file_up_vote->user->first_name}} {{$file_up_vote->user->last_name}}
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
                    <form method="post">
                        @csrf
                        <button class="btn_text" onclick="return shared_file_down_vote({{$shared_file->id}});">
                            <i class="fas fa-chevron-down icon_size_m mr-1 {{Auth::user()->shared_file_votes()->where('shared_file_id',$shared_file->id)->where('vote',-1)->exists() ? 'down_vote' : ''}}"></i>
                        </button>
                        <a href="#show_file_down_votes{{$shared_file->id}}" data-toggle="modal"><span>{{$shared_file->shared_file_votes()->where('vote',-1)->count()}}</span></a>
                    </form>


                    <!-- upvotes  Modal -->
                    <div class="modal fade" id="show_file_down_votes{{$shared_file->id}}" tabindex="-1" role="dialog" aria-labelledby="show_file_down_votes{{$shared_file->id}}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="container">
                                        <h6 class="modal-title font-weight-bold" id="show_file_down_votes{{$shared_file->id}}Title">{{__('text.Downvotes')}}</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        @foreach($shared_file->shared_file_votes()->where('vote',-1)->get() as $file_down_vote)
                                            <a href="{{route('profile.show_user',['user_id'=>$file_down_vote->user->id])}}">
                                                <div class="media">
                                                    <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$file_down_vote->user->profile_image)}}"
                                                         width="40px" height="40px" alt="student_profile">
                                                    <div class="media-body ml-3">
                                                        <div class="font-weight-bold">
                                                            {{$file_down_vote->user->username}}
                                                        </div>
                                                        <div class="text-muted">
                                                            {{$file_down_vote->user->first_name}} {{$file_down_vote->user->last_name}}
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
        </div>


        <div >
            <a class="btn btn-primary" href="{{route('library.shared_file_download',['id'=>$shared_file->id])}}" role="button">{{__('text.Download')}}</a>
        </div>

    </div>
</div>
