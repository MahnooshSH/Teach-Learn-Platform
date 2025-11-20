@extends('library.library')
@section('active_share_file')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="share_file">

            <div class="card card_width_center">
                <div class="card-header">
                    {{__('text.Share File')}}
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('library.create_shared_file')}}" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="caption">{{__('text.caption')}}</label>
                            <textarea class="form-control {{ $errors->has('caption') ? ' is-invalid' : '' }}" id="caption" name="caption" rows="3">{{old('caption')}}</textarea>
                            @if ($errors->has('caption'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('caption') }}</strong>
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

                        <button type="submit" class="btn btn-primary">{{__('text.Share')}}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
