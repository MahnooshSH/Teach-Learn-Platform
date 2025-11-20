<div class="card">
    <div class="card-header d-flex  ">


        <div class="media mr-auto p-0" style="width: 300px">
            <a href="{{route('profile.show_user',['user_id'=>$question->user->id])}}">
                <img class="rounded-circle mr-2" src="{{asset('storage/profile_images/'.$question->user->profile_image)}}" width="38px" height="38px" alt="profile">
            </a>
            <div class="media-body">
                <div class="mt-0 font-weight-bold"><a href="{{route('profile.show_user',['user_id'=>$question->user->id])}}">{{$question->user->username}}</a></div>
                <div class="text-muted text-x-small">{{$question->user->first_name}} {{$question->user->last_name}}</div>
            </div>
        </div>
        <div class="text-muted p-0 mr-4">
            {{ \Carbon\Carbon::parse($question->created_at)->format('F j, Y, g:i a')}}
        </div>


        <div class="dropdown p-0 ">
            <a href="#"  id="menu" data-toggle="dropdown" >
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu">

                @can('update', $question)
                    <a class="dropdown-item" href="{{route('question_answer.edit_question',['id'=>$question->id])}}">{{__('text.Edit')}}</a>
                @endcan
                @can('delete', $question)
                    <a class="dropdown-item" href="{{route('question_answer.delete_question',['id'=>$question->id])}}">{{__('text.Delete')}}</a>
                @endcan
                @can('report', $question)
                    <a class="dropdown-item" href="#">{{__('text.Report')}}</a>
                @endcan

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-title font-weight-bold">
            {{$question->question}}
        </div>

        <pre>{{$question->description}}</pre>


        <div style="font-size: 1.1rem;">

            @foreach($question->tags as $tag)
                <a href="{{route('tag.show_tag',['tag_id'=>$tag->id])}}" class="badge badge-pill badge-secondary">{{$tag->name}}</a>
            @endforeach

        </div>
    </div>

    <div class="card-footer">
        <div>

            <div  class="row">

                <div class="col-sm-auto">
                    <div id="vote{{$question->id}}">
                        <div class="row">
                            <div class="col-sm-auto">
                                <form method="post">
                                    @csrf
                                    <button class="btn_text" onclick="return question_up_vote({{$question->id}});">
                                        <i class="fas fa-chevron-up icon_size_m mr-1 {{Auth::user()->question_votes()->where('question_id',$question->id)->where('vote',1)->exists() ? 'up_vote' : ''}}"></i>
                                    </button>
                                    <a href="#show_question_up_votes{{$question->id}}" data-toggle="modal"><span >{{$question->question_votes()->where('vote',1)->count()}}</span></a>
                                </form>


                                <!-- upvotes  Modal -->
                                <div class="modal fade" id="show_question_up_votes{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="show_question_up_votes{{$question->id}}Title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="container">
                                                    <h6 class="modal-title font-weight-bold" id="show_question_up_votes{{$question->id}}Title">{{__('text.Upvotes')}}</h6>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    @foreach($question->question_votes()->where('vote',1)->get() as $question_up_vote)
                                                        <a href="{{route('profile.show_user',['user_id'=>$question_up_vote->user->id])}}">
                                                            <div class="media">
                                                                <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$question_up_vote->user->profile_image)}}"
                                                                     width="40px" height="40px" alt="student_profile">
                                                                <div class="media-body ml-3">
                                                                    <div class="font-weight-bold">
                                                                        {{$question_up_vote->user->username}}
                                                                    </div>
                                                                    <div class="text-muted">
                                                                        {{$question_up_vote->user->first_name}} {{$question_up_vote->user->last_name}}
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
                                    <button class="btn_text" onclick="return question_down_vote({{$question->id}});">
                                        <i class="fas fa-chevron-down icon_size_m mr-1 {{Auth::user()->question_votes()->where('question_id',$question->id)->where('vote',-1)->exists() ? 'down_vote' : ''}}"></i>
                                    </button>
                                    <a href="#show_question_down_votes{{$question->id}}" data-toggle="modal"><span>{{$question->question_votes()->where('vote',-1)->count()}}</span></a>
                                </form>


                                <!-- Downvotes  Modal -->
                                <div class="modal fade" id="show_question_down_votes{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="show_question_down_votes{{$question->id}}Title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="container">
                                                    <h6 class="modal-title font-weight-bold" id="show_question_down_votes{{$question->id}}Title">{{__('text.Downvotes')}}</h6>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    @foreach($question->question_votes()->where('vote',-1)->get() as $question_down_vote)
                                                        <a href="{{route('profile.show_user',['user_id'=>$question_down_vote->user->id])}}">
                                                            <div class="media">
                                                                <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$question_down_vote->user->profile_image)}}"
                                                                     width="40px" height="40px" alt="student_profile">
                                                                <div class="media-body ml-3">
                                                                    <div class="font-weight-bold">
                                                                        {{$question_down_vote->user->username}}
                                                                    </div>
                                                                    <div class="text-muted">
                                                                        {{$question_down_vote->user->first_name}} {{$question_down_vote->user->last_name}}
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
                </div>

                <div class="col-sm-auto">
                    <a data-toggle="collapse" href="#collapseAnswers{{$question->id}}" role="button" aria-expanded="false" aria-controls="#collapseAnswers{{$question->id}}">
                        <i class="far fa-comment-alt icon_size_m mr-1"></i>
                        <span id="answers_count{{$question->id}}">{{$question->answers()->count()}} {{__('text.'.str_plural('answer',$question->answers()->count()))}}</span>
                    </a>
                </div>

            </div>
            <div class="collapse" id="collapseAnswers{{$question->id}}">
                <div id="answers{{$question->id}}" class="mt-3">
                    <div class="text-justify" style="max-height: 300px; overflow-y: scroll" >

                        <ul class="list-group list-group-flush">

                            @foreach($question->answers()->Orderby('created_at','desc')->get() as $answer)
                                <li class="list-group-item">
                                    <div class="media">
                                        <a href="{{route('profile.show_user',['user_id'=>$answer->user->id])}}">
                                            <img class="rounded-circle mr-3" src="{{asset('storage/profile_images/'.$answer->user->profile_image)}}" width="30px" height="30px" alt="profile">
                                        </a>
                                        <div class="media-body">
                                            <div class="mt-0 font-weight-bold"><a href="{{route('profile.show_user',['user_id'=>$answer->user->id])}}">{{$answer->user->username}}</a></div>

                                            <div id="answer_vote{{$answer->id}}">
                                                <div class="row mt-2 mb-3">
                                                    <div class="col-sm-auto">
                                                        <form method="post">
                                                            @csrf
                                                            <button class="btn_text" onclick="return answer_up_vote({{$answer->id}});">
                                                                <i class="fas fa-chevron-up icon_size_s mr-1 {{Auth::user()->answer_votes()->where('answer_id',$answer->id)->where('vote',1)->exists() ? 'up_vote' : ''}}"></i>
                                                            </button>
                                                            <a href="#show_answer_up_votes{{$answer->id}}" data-toggle="modal"><span >{{$answer->answer_votes()->where('vote',1)->count()}}</span></a>
                                                        </form>


                                                        <!-- Upvotes  Modal -->
                                                        <div class="modal fade" id="show_answer_up_votes{{$answer->id}}" tabindex="-1" role="dialog" aria-labelledby="show_answer_up_votes{{$answer->id}}Title" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="container">
                                                                            <h6 class="modal-title font-weight-bold" id="show_answer_up_votes{{$answer->id}}Title">{{__('text.Upvotes')}}</h6>
                                                                        </div>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container">
                                                                            @foreach($answer->answer_votes()->where('vote',1)->get() as $answer_up_vote)
                                                                                <a href="{{route('profile.show_user',['user_id'=>$answer_up_vote->user->id])}}">
                                                                                    <div class="media">
                                                                                        <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$answer_up_vote->user->profile_image)}}"
                                                                                             width="40px" height="40px" alt="student_profile">
                                                                                        <div class="media-body ml-3">
                                                                                            <div class="font-weight-bold">
                                                                                                {{$answer_up_vote->user->username}}
                                                                                            </div>
                                                                                            <div class="text-muted">
                                                                                                {{$answer_up_vote->user->first_name}} {{$answer_up_vote->user->last_name}}
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
                                                            <button class="btn_text" onclick="return answer_down_vote({{$answer->id}});">
                                                                <i class="fas fa-chevron-down icon_size_s mr-1 {{Auth::user()->answer_votes()->where('answer_id',$answer->id)->where('vote',-1)->exists() ? 'down_vote' : ''}}"></i>
                                                            </button>
                                                            <a href="#show_answer_down_votes{{$answer->id}}" data-toggle="modal"><span>{{$answer->answer_votes()->where('vote',-1)->count()}}</span></a>
                                                        </form>


                                                        <!-- Downvotes  Modal -->
                                                        <div class="modal fade" id="show_answer_down_votes{{$answer->id}}" tabindex="-1" role="dialog" aria-labelledby="show_answer_down_votes{{$answer->id}}Title" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="container">
                                                                            <h6 class="modal-title font-weight-bold" id="show_answer_down_votes{{$answer->id}}Title">{{__('text.Downvotes')}}</h6>
                                                                        </div>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container">
                                                                            @foreach($answer->answer_votes()->where('vote',-1)->get() as $answer_down_vote)
                                                                                <a href="{{route('profile.show_user',['user_id'=>$answer_down_vote->user->id])}}">
                                                                                    <div class="media">
                                                                                        <img class="rounded-circle" src="{{asset('/storage/profile_images/'.$answer_down_vote->user->profile_image)}}"
                                                                                             width="40px" height="40px" alt="student_profile">
                                                                                        <div class="media-body ml-3">
                                                                                            <div class="font-weight-bold">
                                                                                                {{$answer_down_vote->user->username}}
                                                                                            </div>
                                                                                            <div class="text-muted">
                                                                                                {{$answer_down_vote->user->first_name}} {{$answer_down_vote->user->last_name}}
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
                                            <pre>{{$answer->answer}}</pre>

                                        </div>
                                    </div>
                                </li>
                            @endforeach


                        </ul>

                    </div>
                    <form method="post" id="answer_form{{$question->id}}">
                        <div class="form-inline justify-content-between mt-3">
                            @csrf
                            <textarea class="form-control col-lg-9" id="answer{{$question->id}}" name="answer{{$question->id}}" placeholder="{{__('text.Add an answer...')}}" maxlength="3000" rows="3"></textarea>
                            <button type="submit" class="btn btn-secondary col-lg-2" onclick="return add_answer({{$question->id}});">{{__('text.Send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
