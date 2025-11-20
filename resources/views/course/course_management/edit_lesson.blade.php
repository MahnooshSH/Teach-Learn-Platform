@extends('course.course_management.course_management')



@section('manage_course')

    <div class="card card_width_center">
        <div class="card-header">
            {{__('text.Edit Lesson')}}
        </div>
        <div class="card-body">
            <form method="post" action="{{route('course.update_lesson',['course_id'=>$course->id,'lesson_id'=>$lesson->id])}}">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="lesson_number">{{__('text.lesson number')}}</label>
                    <input type="number" class="form-control{{ $errors->has('lesson_number') ? ' is-invalid' : '' }}"  id="lesson_number" name="lesson_number"  value="{{$lesson->lesson_number}}">
                    @if ($errors->has('lesson_number'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lesson_number') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">{{__('text.title')}}</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.Lesson Title')}}" value="{{$lesson->title}}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">{{__('text.description')}}</label>
                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="4" placeholder="{{__('text.Lesson Description')}}">{{$lesson->description}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">{{__('text.Update')}}</button>
            </form>
        </div>
    </div>

@endsection
