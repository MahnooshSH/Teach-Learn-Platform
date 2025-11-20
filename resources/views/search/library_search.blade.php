@extends('search.search')
@section('active_library')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="library_search">

            <div class="row">
                <div class="col-md-3">
                    <div class="card sticky-side-menu-top mt-3">
                        <div class="card-body">


                            <form method="get" action="{{route('search.search_shared_file')}}">

                                <div class="form-group">
                                    <textarea class="form-control {{$errors->has('content') ? 'is-invalid' : '' }}" id="content" name="content" rows="4" placeholder="{{__('text.Search in shared files ...')}}">@isset($content){{$content}}@endisset</textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="tags">{{__('text.tags')}}</label>
                                    <select multiple  class="custom-select {{ $errors->has('tags.*') ? ' is-invalid' : '' }}" data-role="tagsinput"  id="tags[]" name="tags[]" placeholder="{{__('text.Add tags with space')}}">

                                        @isset($tags)
                                            @foreach($tags as $tag)
                                                <option selected value="{{$tag}}">{{$tag}}</option>
                                            @endforeach
                                        @endisset

                                    </select>
                                    @if ($errors->has('tags.*'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tags.*') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search icon_size_s"></i></button>
                            </form>


                        </div>
                    </div>

                </div>

                <div class="col-md-9">


                    @empty($shared_files)

                        <div class="d-flex justify-content-center mt-5 mb-3">
                            <img class="img-fluid" src="{{asset('images/search_show.png')}}" width="220px"  alt="">
                        </div>

                    @endempty


                    @isset($shared_files)

                        @foreach($shared_files as $shared_file)
                            @include('library.show_shared_file')
                        @endforeach

                        @if($shared_files->count()==0)

                            <div class="d-flex justify-content-center text-muted h2 mt-5">
                                {{__('text.No results found')}}
                            </div>

                        @endif

                    @endisset



                </div>
            </div>

        </div>
    </div>
@endsection
