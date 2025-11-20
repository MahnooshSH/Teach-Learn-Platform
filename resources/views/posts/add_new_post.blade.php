@extends('posts.posts')
@section('active_add_new_post')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="add_new_post">
            <div class="card card_width_center">
                <div class="card-header">
                    {{__('text.Create New Post')}}
                </div>
                <div class="card-body">

                <form method="post" action="{{route('posts.create_new_post')}}" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label for="post_content">{{__('text.post content')}}</label>
                        <textarea class="form-control {{ $errors->has('post_content') ? ' is-invalid' : '' }}" id="post_content" name="post_content" rows="4" placeholder="">{{old('post_content')}}</textarea>
                        @if ($errors->has('post_content'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_content') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="post_file">{{__('text.post file')}}</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{ $errors->has('post_file') ? ' is-invalid' : '' }}" id="post_file" name="post_file">
                        <label class="custom-file-label" for="post_file" >{{__('text.Choose an image or video for your post...')}}</label>
                        @if ($errors->has('post_file'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_file') }}</strong>
                                    </span>
                        @endif
                    </div>
                        <div class="mt-2" id="show_post_file"></div>
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
