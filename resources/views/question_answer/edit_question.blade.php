@extends('question_answer.question_answer')

@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="edit_question">

            <div class="card card_width_center">
                <div class="card-header">
                    {{__('text.Edit Question')}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('question_answer.update_question',['id'=>$question->id])}}">
                        @csrf

                        <div class="form-group">
                            <label for="question">{{__('text.question')}}</label>
                            <textarea class="form-control {{$errors->has('question') ? 'is-invalid' : '' }}" id="question" name="question" rows="2">{{$question->question}}</textarea>
                            @if ($errors->has('question'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="description">{{__('text.description')}}</label>
                            <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="4">{{$question->description}}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tags">{{__('text.tags')}}</label>
                            <select multiple  class="custom-select {{ $errors->has('tags.*') ? ' is-invalid' : '' }}" data-role="tagsinput"  id="tags[]" name="tags[]" placeholder="{{__('text.Add tags with space')}}">
                                @foreach($question->tags as $tag)
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

        </div>
    </div>
@endsection
