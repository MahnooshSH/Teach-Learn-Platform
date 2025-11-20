

    <div class="card card_width_center">
        <div class="card-header d-flex">

            <div class="media mr-auto p-0" style="width: 300px;">
                <a href="{{route('profile.show_user',['user_id'=>$post->user->id])}}">
                    <img class="rounded-circle mr-2" src="{{asset('storage/profile_images/'.$post->user->profile_image)}}" width="38px" height="38px" alt="profile">
                </a>
                <div class="media-body">
                    <div class="mt-0 font-weight-bold"><a href="{{route('profile.show_user',['user_id'=>$post->user->id])}}">{{$post->user->username}}</a></div>
                    <div class="text-muted text-x-small">{{$post->user->first_name}} {{$post->user->last_name}}</div>
                </div>
            </div>
            <div class="text-muted p-0 mr-3">
                {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y, g:i a')}}
            </div>
            <div class="dropdown p-0">
                <a href="#"  id="menu" data-toggle="dropdown" >
                    <i class="fas fa-ellipsis-h"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu">

                    @can('update', $post)
                        <a class="dropdown-item" href="{{route('posts.edit_post',['id'=>$post->id])}}">{{__('text.Edit')}}</a>
                    @endcan
                    @can('delete', $post)
                        <a class="dropdown-item" href="{{route('posts.delete_post',['id'=>$post->id])}}">{{__('text.Delete')}}</a>
                    @endcan
                    @can('report', $post)
                        <a class="dropdown-item" href="#">{{__('text.Report')}}</a>
                    @endcan


                </div>
            </div>
        </div>
        <div class="">
            @if(strpos($post->post_file_type,'image')>-1)

                <div>
                    <img src="{{asset('storage/'.$post->post_file)}}" width="720px" class="img-fluid" alt="post">
                </div>

            @elseif(strpos($post->post_file_type,'video')>-1)

                <div>
                    <video width="720px" class="img-fluid"  controls>
                        <source src="{{asset('storage/'.$post->post_file)}}" type="{{$post->post_file_type}}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif

            <div class="card-body text-justify" >

                <pre>{{$post->post_content}}</pre>

                <div style="font-size: 1.1rem">
                    @foreach($post->tags as $tag)
                        <a href="{{route('tag.show_tag',['tag_id'=>$tag->id])}}" class="badge badge-pill badge-secondary">{{$tag->name}}</a>
                    @endforeach
                </div>


            </div>


        </div>
        <div class="card-footer">
            <div>

                <div class="row ">
                    <div  class="col-sm-auto">
                        <div id="like_{{$post->id}}">

                            <form method="post">
                                @csrf
                                <button class="btn_text" onclick="return like_post({{$post->id}});"><i class="{{Auth::user()->post_likes()->where('post_id',$post->id)->exists() ? 'fas fa-thumbs-up icon_size_l liked_blue' : 'far fa-thumbs-up icon_size_l'}} mr-1"></i></button>
                                <a href="#show_likes_{{$post->id}}" data-toggle="modal"><span>{{$post->post_likes()->count()}} {{__('text.'.str_plural('like', $post->post_likes()->count()))}}</span></a>
                            </form>


                            <!-- Likes  Modal -->
                            <div class="modal fade" id="show_likes_{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="show_likes_{{$post->id}}Title" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="container">
                                                <h6 class="modal-title font-weight-bold" id="show_likes_{{$post->id}}Title">{{__('text.Likes')}}</h6>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                @foreach($post->post_likes as $post_like)
                                                    <a href="{{route('profile.show_user',['user_id'=>$post_like->user->id])}}">
                                                        <div class="media">
                                                            <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$post_like->user->profile_image)}}"
                                                                 width="40px" height="40px" alt="student_profile">
                                                            <div class="media-body ml-3">
                                                                <div class="font-weight-bold">
                                                                    {{$post_like->user->username}}
                                                                </div>
                                                                <div class="text-muted">
                                                                    {{$post_like->user->first_name}} {{$post_like->user->last_name}}
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
                    <div class="col-sm-auto">
                        <a data-toggle="collapse" href="#collapseExample{{$post->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="far fa-comment icon_size_l mr-1"></i>
                            <span id="com_count_{{$post->id}}"> {{$post->comments()->count()}} {{__('text.'.str_plural('comment', $post->comments()->count()))}}</span>
                        </a>
                    </div>
                </div>





                <div class="collapse" id="collapseExample{{$post->id}}">

                    <div id="com{{$post->id}}" class="mt-3">
                        <div class="text-justify" style="max-height: 350px; overflow-y: scroll;" >



                            <ul class="list-group list-group-flush">
                                @foreach($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
                                    <li class="list-group-item">
                                        <div class="media">
                                            <a href="{{route('profile.show_user',['user_id'=>$comment->user->id])}}">
                                                <img class="rounded-circle mr-3" src="{{asset('storage/profile_images/'.$comment->user->profile_image)}}" width="30px" height="30px" alt="profile">
                                            </a>
                                            <div class="media-body">
                                                <div class="mt-0 font-weight-bold"><a href="{{route('profile.show_user',['user_id'=>$comment->user->id])}}">{{$comment->user->username}}</a></div>
                                                <pre>{{$comment->content}}</pre>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                        <form method="post" id="comment_form_{{$post->id}}">
                            <div class="form-inline justify-content-between mt-3" >
                                @csrf
                                <textarea class="form-control col-lg-9" id="content{{$post->id}}" name="content{{$post->id}}" placeholder="{{__('text.Add a comment...')}}" rows="3" required></textarea>
                                <button type="submit" class="btn btn-secondary col-lg-2"  onclick="return add_comment({{$post->id}});">{{__('text.Send')}}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

