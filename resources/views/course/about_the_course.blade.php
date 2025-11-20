@extends('course.course')
@section('active_about_the_course')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="about_the_course">

            <div class="card">
                <div class="card-body text-justify">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <img src="{{asset('storage/'.$course->course_image)}}" alt="couldn't load image" width="350" class="rounded-lg img-fluid" >
                        </div>
                        <div class="col-md-8 mb-3 ">
                            <div class="mb-2">
                                <h4>{{$course->title}}</h4>
                            </div>
                            <div class=" mb-4">
                                <div class="text-muted">
                                    {{__('text.by:')}}
                                    <div>
                                    <a href="{{route('profile.show_user',['user_id'=>$course->teacher->id])}}">
                                        {{$course->teacher->first_name}} {{$course->teacher->last_name}}
                                        <img class="rounded-circle mr-1 ml-2" src="{{asset('storage/profile_images/'.$course->teacher->profile_image)}}" alt="pro" width="25px" height="25px" >
                                        <span class="text-muted">{{$course->teacher->username}}</span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">

                                @php
                                    $course_rate=$course->course_rating->rate;
                                @endphp

                                @isset($course_rate)

                                    {{$course_rate}}

                                    @if($course_rate < 1 && $course_rate >= 0.5)
                                        <i class="fas fa-star-half-alt star_yellow"></i>
                                    @elseif($course_rate < 1)
                                        <i class="far fa-star star_yellow"></i>
                                    @else
                                        <i class="fas fa-star star_yellow"></i>
                                    @endif

                                    @if($course_rate < 2 && $course_rate >= 1.5)
                                        <i class="fas fa-star-half-alt star_yellow"></i>
                                    @elseif($course_rate < 2)
                                        <i class="far fa-star star_yellow"></i>
                                    @else
                                        <i class="fas fa-star star_yellow"></i>
                                    @endif

                                    @if($course_rate < 3 && $course_rate >= 2.5)
                                        <i class="fas fa-star-half-alt star_yellow"></i>
                                    @elseif($course_rate < 3)
                                        <i class="far fa-star star_yellow"></i>
                                    @else
                                        <i class="fas fa-star star_yellow"></i>
                                    @endif

                                    @if($course_rate < 4 && $course_rate >= 3.5)
                                        <i class="fas fa-star-half-alt star_yellow"></i>
                                    @elseif($course_rate < 4)
                                        <i class="far fa-star star_yellow"></i>
                                    @else
                                        <i class="fas fa-star star_yellow"></i>
                                    @endif

                                    @if($course_rate < 5 && $course_rate >= 4.5)
                                        <i class="fas fa-star-half-alt star_yellow"></i>
                                    @elseif($course_rate < 5)
                                        <i class="far fa-star star_yellow"></i>
                                    @else
                                        <i class="fas fa-star star_yellow"></i>
                                    @endif

                                @endisset


                                <span class="text-muted">
                                    {{$course->course_rating->review_count}}
                                    {{__('text.'.str_plural('review', $course->course_rating->review_count))}}
                                </span>


                            </div>

                            <div id="register">
                                @cannot('teacher_access', $course)

                                    @can('student_access', $course)
                                        <button class="btn btn-outline-primary" onclick="return leave_course({{$course->id}});">{{__('text.Leave Course')}}</button>
                                    @endcan

                                    @cannot('student_access', $course)
                                        <button class="btn btn-primary" onclick="return course_register({{$course->id}});">{{__('text.Register')}}</button>
                                    @endcannot

                                @endcannot
                            </div>
                        </div>
                    </div>

                    <pre>{{$course->overview}}</pre>

                    <div class="mt-3" style="font-size: 20px">

                        @foreach($course->tags as $tag)
                            <a href="{{route('tag.show_tag',['tag_id'=>$tag->id])}}" class="badge badge-pill badge-secondary">{{$tag->name}}</a>
                        @endforeach

                    </div>


                    <div id="send_review" class="container">
                        @can('student_access',$course)
                        <hr/>
                            <div >
                                <div> {{__('text.Write a review about this course :')}}</div>
                                <form method="post" action="{{route('course.send_review',['course_id'=>$course->id])}}">
                                    @csrf
                                    <div class="rate">

                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" >5</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" >4</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" >3</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" >2</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" >1</label>


                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="comment" name="comment" placeholder="{{__('text.Describe your experience...')}}" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__('text.Send')}}</button>
                                </form>
                            </div>
                        @endcan
                    </div>


                    <div>
                        <hr/>
                        {{__('text.reviews :')}}
                        <ul class="list-group list-group-flush">

                            @foreach($course->course_reviews()->orderBy('created_at','desc')->get() as $review)

                                <li class="list-group-item">
                                    <div class="media">
                                        <a href="{{route('profile.show_user',['user_id'=>$review->user->id])}}">
                                            <img class="rounded-circle mr-3" src="{{asset('/storage/profile_images/'.$review->user->profile_image)}}" width="30px" height="30px" alt="profile">
                                        </a>
                                        <div class="media-body">
                                            <div class="mt-0 font-weight-bold">
                                                <a href="{{route('profile.show_user',['user_id'=>$review->user->id])}}">
                                                    {{$review->user->username}}
                                                </a>
                                            </div>
                                            <div class="mt-1 mb-2">

                                                @if($review->rate < 1)
                                                        <i class="far fa-star star_yellow"></i>
                                                    @else
                                                        <i class="fas fa-star star_yellow"></i>
                                                    @endif

                                                    @if($review->rate < 2)
                                                        <i class="far fa-star star_yellow"></i>
                                                    @else
                                                        <i class="fas fa-star star_yellow"></i>
                                                    @endif

                                                    @if($review->rate < 3)
                                                        <i class="far fa-star star_yellow"></i>
                                                    @else
                                                        <i class="fas fa-star star_yellow"></i>
                                                    @endif

                                                    @if($review->rate < 4)
                                                        <i class="far fa-star star_yellow"></i>
                                                    @else
                                                        <i class="fas fa-star star_yellow"></i>
                                                    @endif

                                                    @if($review->rate < 5)
                                                        <i class="far fa-star star_yellow"></i>
                                                    @else
                                                        <i class="fas fa-star star_yellow"></i>
                                                    @endif


                                            </div>

                                            <pre>{{$review->comment}}</pre>

                                        </div>
                                    </div>
                                </li>

                            @endforeach



                        </ul>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
