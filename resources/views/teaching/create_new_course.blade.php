@extends('teaching.teaching')
@section('active_create_new_course')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="create_new_course">



            <div class="card card_width_center">
                <div class="card-header">
                    {{__('text.Create New Course')}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('teaching.create_course')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">{{__('text.title')}}</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.Course Title')}}" value="{{old('title')}}">
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
                                <label class="custom-file-label" for="file">{{__('text.Choose an image...')}}</label>
                                @if ($errors->has('course_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('course_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div id="show_course_image" class="mt-3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="overview">{{__('text.overview')}}</label>
                            <textarea class="form-control {{ $errors->has('overview') ? ' is-invalid' : '' }}" id="overview" name="overview" rows="3">{{old('overview')}}</textarea>
                            @if ($errors->has('overview'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('overview') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tags">{{__('text.tags')}}</label>
                            <select multiple  class="custom-select {{ $errors->has('tags.*') ? ' is-invalid' : '' }}" data-role="tagsinput"  id="tags[]" name="tags[]" placeholder="{{__('text.Add tags with space')}}">

                                @php($tags=collect(old('tags')))
                                @foreach($tags as $tag)
                                    <option selected value="{{$tag}}">{{$tag}}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('tags.*'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags.*') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">{{__('text.Create')}}</button>
                    </form>
                </div>
            </div>



        </div>
    </div>
@endsection
