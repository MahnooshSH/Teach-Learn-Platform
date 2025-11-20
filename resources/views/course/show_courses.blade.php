<div class="col-xl-4 col-md-5 mb-1 ">
    <a href="{{route('course.about_the_course',['id'=>$course->id])}}">
        <div class="card course_box" >

            <img src="{{asset('storage/'.$course->course_image)}}" alt="couldn't load image" width="400" class="img-fluid" >
            <div class="card-body text-justify" style="height: 140px;">
                <h5 class="course_title text-center d-flex align-items-center justify-content-center">
                    {{$course->title}}
                </h5>
            </div>

            <div class="card-footer text-center p-1">
                <a href="{{route('profile.show_user',['user_id'=>$course->teacher->id])}}" >
                    <div>{{$course->teacher->first_name}} {{$course->teacher->last_name}}</div>
                    <div class="text-muted text-x-small">
                        <img class="rounded-circle mr-1" src="{{asset('storage/profile_images/'.$course->teacher->profile_image)}}" width="20px" height="20px" alt="profile">
                        {{$course->teacher->username}}
                    </div>
                </a>
            </div>
            <div class="card-footer text-center">


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
        </div>
    </a>
</div>
