@extends('course.course_management.course_management')

@section('active_edit_course_info')
    active
@endsection

@section('manage_course')
    <div class="card card_width_center">
        <div class="card-header">
            {{__('text.Edit Course Info')}}
        </div>
        <div class="card-body">
            <form method="post" action="{{route('course.update_course_info',['id'=>$course->id])}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">{{__('text.title')}}</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.Course Title')}}" value="{{$course->title}}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="course_image">{{__('text.course image')}}</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{ $errors->has('course_image') ? ' is-invalid' : '' }}" id="course_image" name="course_image" >
                        <label class="custom-file-label" for="file">{{__('text.Choose a new image')}}</label>
                        @if ($errors->has('course_image'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('course_image') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div id="show_course_image" class="mt-3">
                        <img id="course_img" class="img-fluid rounded" src="{{asset('storage/'.$course->course_image)}}" alt="course_image" width="250px">
                    </div>
                </div>

                <div class="form-group">
                    <label for="overview">{{__('text.overview')}}</label>
                    <textarea class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}" id="overview" name="overview" rows="6">{{$course->overview}}</textarea>
                    @if ($errors->has('overview'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('overview') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="tags">{{__('text.tags')}}</label>
                    <select multiple  class="custom-select {{ $errors->has('tags.*') ? ' is-invalid' : '' }}" data-role="tagsinput"  id="tags[]" name="tags[]" placeholder="{{__('text.Add tags with space')}}">

                        @foreach($course->tags as $tag)
                            <option selected value="{{$tag->name}}">{{$tag->name}}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('tags.*'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags.*') }}</strong>
                                    </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">{{__('text.Update')}}</button>
            </form>
        </div>
    </div>

@endsection
