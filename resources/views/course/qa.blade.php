@extends('course.course')
@section('active_qa')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="qa">

            @if (Auth::user()->can('teacher_access', $course) || Auth::user()->can('student_access', $course) )
                <div class="card bg-light">
                    <div class="card-body">
                        <div id="ask_question">
                        <p>
                            <a class="btn btn-outline-primary" data-toggle="collapse" href="#add_course_question" role="button" aria-expanded="false" aria-controls="add_course_question">
                                {{__('text.Ask a new question')}}
                            </a>
                        </p>
                        <div class="collapse" id="add_course_question">
                            <div class="card card-body">
                                 <form method="post">
                                     @csrf
                                     <div class="form-group">
                                         <textarea class="form-control" id="question" name="question" rows="3" placeholder="{{__('text.Write your question')}}"></textarea>
                                     </div>
                                     <button type="submit" class="btn btn-primary" onclick="return add_course_question({{$course->id}});">
                                         {{__('text.Send')}}
                                     </button>
                                 </form>
                            </div>
                        </div>
                        </div>

                        <div id="course_questions">
                        @foreach($course->course_questions()->orderBy('created_at','desc')->get() as $question)
                            <div class="card">
                                <div class="card-header d-flex  ">


                                    <div class="media mr-auto p-0" style="width: 320px">
                                        <a href="{{route('profile.show_user',['user_id'=>$question->user->id])}}">
                                            <img class="rounded-circle mr-2" src="{{asset('storage/profile_images/'.$question->user->profile_image)}}" width="38px" height="38px" alt="profile">
                                        </a>
                                        <div class="media-body">
                                            <div class="row">
                                            <div class="mt-0 font-weight-bold col-sm-auto"><a href="{{route('profile.show_user',['user_id'=>$question->user->id])}}">{{$question->user->username}}</a></div>
                                            <div class="col-sm-auto">
                                                @if($question->user->username==$course->teacher->username)
                                                    <div class="badge badge-pill badge-success" >
                                                        {{__('text.Course Instructor')}}
                                                    </div>
                                                @endif
                                            </div>
                                            </div>
                                            <div class="text-muted text-x-small">{{$question->user->first_name}} {{$question->user->last_name}}</div>
                                        </div>

                                    </div>

                                <div class="text-muted p-0 mr-4">
                                        {{ \Carbon\Carbon::parse($question->created_at)->format('F j, Y, g:i a')}}
                                    </div>

                                </div>
                                <div class="card-body">
                                    <pre>{{$question->question}}</pre>
                                </div>

                                <div class="card-footer">
                                    <div>

                                        <div  class="row">

                                            <div class="col-sm-auto">
                                                <a data-toggle="collapse" href="#collapseAnswers{{$question->id}}" role="button" aria-expanded="false" aria-controls="#collapseAnswers{{$question->id}}">
                                                    <i class="far fa-comment-alt icon_size_m mr-1"></i>
                                                    <span id="course_answers_count{{$question->id}}">{{$question->course_answers()->count()}} {{__('text.'.str_plural('answer',$question->course_answers()->count()))}}</span>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="collapse" id="collapseAnswers{{$question->id}}">
                                            <div id="course_answers{{$question->id}}" class="mt-3">
                                                <div class="text-justify" style="max-height: 300px; overflow-y: scroll" >

                                                    <ul class="list-group list-group-flush">

                                                        @foreach($question->course_answers()->Orderby('created_at','desc')->get() as $answer)
                                                            <li class="list-group-item">
                                                                <div class="media">
                                                                    <a href="{{route('profile.show_user',['user_id'=>$answer->user->id])}}">
                                                                        <img class="rounded-circle mr-3" src="{{asset('storage/profile_images/'.$answer->user->profile_image)}}" width="30px" height="30px" alt="profile">
                                                                    </a>
                                                                    <div class="media-body">
                                                                        <div class="row">
                                                                        <div class="mt-0 font-weight-bold col-sm-auto"><a href="{{route('profile.show_user',['user_id'=>$answer->user->id])}}">{{$answer->user->username}}</a></div>

                                                                        <div class="col-sm-auto">
                                                                            @if($answer->user->username==$course->teacher->username)
                                                                                <div class="badge badge-pill badge-success" >
                                                                                    {{__('text.Course Instructor')}}
                                                                                </div>
                                                                            @endif
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
                                                        <button type="submit" class="btn btn-secondary col-lg-2" onclick="return add_course_answer({{$question->id}});">{{__('text.Send')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted h4 text-center mt-5 mb-5">
                            {{__('text.You must first register to access course questions and answers')}}
                        </div>
                    </div>
                </div>
            @endif



        </div>
    </div>
@endsection
