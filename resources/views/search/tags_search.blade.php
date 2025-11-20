@extends('search.search')
@section('active_tags')
    active
@endsection
@section('tab_content')



    @empty($tag)

        <div class="d-flex justify-content-center mt-5 mb-3">
            <img class="img-fluid" src="{{asset('images/search_show.png')}}" width="200px"  alt="">
        </div>

    @endempty

    <div class="d-flex justify-content-center mt-3">
        <div class="col-lg-6">

            <form method="get" action="{{route('search.search_tag')}}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{__('text.Search tags ...')}}" id="search_tag" name="search_tag" value="@isset($tag){{$tag->name}}@endisset" aria-label="Search tags" aria-describedby="tag_search" autocomplete="off" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" id="tag_search"><i class="fas fa-search icon_size_s"></i></button>
                    </div>
                </div>
            </form>


            <div id="live_search_tag" class="bg-white"></div>

        </div>

    </div>


    <div class="tab-content">
        <div class="tab-pane active" id="tags_search">
            @isset($tag)

                @include('tags.show_tag')

            @endisset
            @isset($no_find)

                    <div class="d-flex justify-content-center text-muted h3">
                        {{__('text.No results found')}}
                    </div>

                @endisset


        </div>
    </div>
@endsection
