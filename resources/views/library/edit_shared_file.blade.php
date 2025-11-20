@extends('library.library')

@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="edit_share_file">

            <div class="card card_width_center">
                <div class="card-header">
                    {{__('text.Edit Shared File')}}
                </div>

                <div class="card-body">

                    <div class="text-muted mb-2 text-small">
                        {{$shared_file->title.'.'.$shared_file->file_type}}
                    </div>


                    <form method="post" action="{{route('library.update_shared_file',['id'=>$shared_file->id])}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="title">{{__('text.title')}}</label>
                            <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  id="title" name="title" placeholder="{{__('text.title')}}" value="{{$shared_file->title}}">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="caption">{{__('text.caption')}}</label>
                            <textarea class="form-control {{ $errors->has('caption') ? ' is-invalid' : '' }}" id="caption" name="caption" rows="3">{{$shared_file->caption}}</textarea>
                            @if ($errors->has('caption'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('caption') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tags">{{__('text.tags')}}</label>
                            <select multiple  class="custom-select {{ $errors->has('tags.*') ? ' is-invalid' : '' }}" data-role="tagsinput"  id="tags[]" name="tags[]" placeholder="{{__('text.Add tags with space')}}">
                                @foreach($shared_file->tags as $tag)
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
