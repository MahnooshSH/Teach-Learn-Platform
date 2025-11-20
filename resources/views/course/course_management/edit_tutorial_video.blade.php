@extends('course.course_management.course_management')


@section('manage_course')
    <div class="card card_width_center">
        <div class="card-header">
            {{__('text.Edit Tutorial Video')}}
        </div>
        <div class="card-body">

            <form method="post" action="{{route('course.update_tutorial_video',['course_id'=>$course->id,'tutorial_video_id'=>$tutorial_video->id])}}" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="title">{{__('text.title')}}</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.Tutorial Video Title')}}" value="{{$tutorial_video->title}}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="tutorial_video">{{__('text.tutorial video')}}</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{ $errors->has('tutorial_video') ? ' is-invalid' : '' }}" id="tutorial_video" name="tutorial_video">
                        <label class="custom-file-label" for="tutorial_video" >{{__('text.Choose a video ...')}}</label>
                        @if ($errors->has('tutorial_video'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tutorial_video') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="mt-2" id="show_tutorial_video">

                        <video  width="540px" class="img-fluid" controls>
                            <source id="tut_vid" src="{{asset('storage/'.$tutorial_video->tutorial_video)}}" type="video/mp4">
                        </video>

                    </div>
                </div>


                <button type="submit" class="btn btn-primary">{{__('text.Update')}}</button>
            </form>
        </div>
    </div>

@endsection
