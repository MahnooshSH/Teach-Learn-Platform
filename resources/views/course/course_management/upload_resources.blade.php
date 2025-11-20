@extends('course.course_management.course_management')



@section('manage_course')

    <div class="card">

        <div class="card-body">
            <form method="post" action="{{route('course.create_resources',['course_id'=>$course->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">{{__('text.title')}}</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.title')}}" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="file">{{__('text.file')}}</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{ $errors->has('file') ? ' is-invalid' : '' }}" id="file" name="file" >
                        <label class="custom-file-label" for="file">{{__('text.Choose a file....')}}</label>
                        @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">{{__('text.Save')}}</button>
            </form>
        </div>
    </div>

@endsection
