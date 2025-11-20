@extends('posts.posts')

@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="edit_post">
            <div class="card card_width_center">
                <div class="card-header">
                    {{__('text.Edit Post')}}
                </div>
                <div class="card-body">

                    <form method="post" action="{{route('posts.update_post',['id'=>$post->id])}}" enctype="multipart/form-data">

                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="post_content">{{__('text.post content')}}</label>
                            <textarea class="form-control {{ $errors->has('post_content') ? ' is-invalid' : '' }}" id="post_content" name="post_content" rows="4" placeholder="">{{$post->post_content}}</textarea>
                            @if ($errors->has('post_content'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_content') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="post_file">{{__('text.post file')}}</label>
                            <div class="custom-file" >
                                <input type="file" class="custom-file-input {{ $errors->has('post_file') ? ' is-invalid' : '' }}" id="post_file" name="post_file" >
                                <label class="custom-file-label" for="post_file" style="height: auto">

                                    {{__('text.Choose an image or video for your post...')}}
                                </label>
                                @if ($errors->has('post_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mt-2" id="show_post_file">
                            @if(strpos($post->post_file_type,'image')>-1)

                                <div>
                                    <img src="{{asset('storage/'.$post->post_file)}}" width="200px" class="img-fluid" alt="post">
                                </div>
                                    <a id="delete_old_post_file" class="btn btn-outline-secondary btn-sm mt-3" onclick="return delete_old_post_file();">{{__('text.delete old post file')}}</a>
                            @elseif(strpos($post->post_file_type,'video')>-1)

                                <div>
                                    <video width="200px" class="img-fluid"  controls>
                                        <source src="{{asset('storage/'.$post->post_file)}}" type="{{$post->post_file_type}}">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                    <a id="delete_old_post_file" class="btn btn-outline-secondary btn-sm mt-3" onclick="return delete_old_post_file();">{{__('text.delete old post file')}}</a>
                            @endif
                            </div>


                        </div>
                        <input id="delete_file" name="delete_file" type="hidden" value="0">

                        <div class="form-group">
                            <label for="tags">{{__('text.tags')}}</label>
                            <select multiple  class="custom-select {{ $errors->has('tags.*') ? ' is-invalid' : '' }}" data-role="tagsinput"  id="tags[]" name="tags[]" placeholder="{{__('text.Add tags with space')}}">
                                @foreach($post->tags as $tag)

                                    <option selected value="{{$tag->name}}">{{$tag->name}}</option>
                                    @endforeach
                            </select>
                            @if ($errors->has('tags.*'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags.*') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-inline">
                            <button type="submit" class="btn btn-primary mr-3">{{__('text.Update')}}</button>
                            <a class="btn btn-outline-primary " href="{{route('posts.my_posts')}}" >{{__('text.Cancel')}}</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
