@extends('course.course_management.course_management')



@section('manage_course')

    <div class="card card_width_center">
        <div class="card-header">
            {{__('text.Create New Quiz')}}
        </div>
        <div class="card-body">
            <form method="post" action="{{route('course.create_quiz',['course_id'=>$course->id,'lesson_id'=>$lesson->id])}}">
                @csrf



                <div class="form-group">
                    <label for="title">{{__('text.title')}}</label>
                    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.Quiz Title')}}" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">{{__('text.description')}}</label>
                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="4" placeholder="{{__('text.Quiz Description')}}">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="time_is_limited" name="time_is_limited"
                               @if( old('time_is_limited') )
                               checked
                            @endif
                        >
                        <label class="form-check-label" for="time_is_limited">
                            {{__('text.Quiz time is limited')}}
                        </label>
                    </div>
                </div>

                <div id="time_limited" class="form-group form-inline "
                     @if(! old('time_is_limited') )
                     style="display: none"
                     @endif
                >
                    <label for="time_limitation">{{__('text.time limitation')}}</label>
                    <div class="col-md-6">
                    <input type="number" class="form-control {{ $errors->has('time_limitation') ? ' is-invalid' : '' }}"  id="time_limitation" name="time_limitation" value="{{old('time_limitation')}}">
                        {{__('text.minutes')}}
                        </div>
                        @if ($errors->has('time_limitation'))
                            <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('time_limitation') }}</strong>
                                    </span>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">{{__('text.Save and Continue')}}</button>
            </form>
        </div>
    </div>

@endsection
