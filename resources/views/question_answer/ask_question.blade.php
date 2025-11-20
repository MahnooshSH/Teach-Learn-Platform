@extends('question_answer.question_answer')
@section('active_ask_question')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="ask_question">

            <div class="card card_width_center">
                <div class="card-header">
                    {{__('text.Ask Question')}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('question_answer.create_new_question')}}">
                        @csrf

                        <div class="form-group">
                            <label for="question">{{__('text.question')}}</label>
                            <textarea class="form-control {{$errors->has('question') ? 'is-invalid' : '' }}" id="question" name="question" rows="2">{{old('question')}}</textarea>
                            @if ($errors->has('question'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">{{__('text.description')}}</label>
                            <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="4">{{old('description')}}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
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
                        <button type="submit" class="btn btn-primary">{{__('text.Save')}}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
