@extends('search.search')

@section('tab_content')


    @empty($search)

        <div class="d-flex justify-content-center mt-5 mb-3">
        <img class="img-fluid" src="{{asset('images/search_show.png')}}" width="200px"  alt="">
        </div>

    @endempty
    <div class="d-flex justify-content-center mt-3">
        <div class="col-lg-6">

            <form method="get" action="{{route('search.all_search')}}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{__('text.Search ...')}}" id="search" name="search" value="@isset($search){{$search}}@endisset" aria-label="Search" aria-describedby="search" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" id="search"><i class="fas fa-search icon_size_s"></i></button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="search">
            @isset($search)


                <div class="d-flex justify-content-center mr-5">


                    <div class="text-center h5 alert">
                        {{__('text.Search results')}} :
                    </div>


                <nav>
                    <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">

                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">
                            {{$courses->count()}} {{__('text.Courses')}}
                        </a>
                        <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                            {{$posts->count()}} {{__('text.Posts')}}
                        </a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#shared_files" role="tab" aria-controls="shared_files" aria-selected="false">
                            {{$shared_files->count()}} {{__('text.Shared files')}}
                        </a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="questions" aria-selected="false">
                            {{$questions->count()}} {{__('text.Questions')}}
                        </a>

                    </div>
                </nav>
                </div>


                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="nav-contact-tab">

                        <div class="row">
                            @foreach($courses as $course)
                                @include('course.show_courses')
                            @endforeach
                        </div>

                    </div>
                    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="nav-home-tab">

                        @foreach($posts as $post)
                            @include('posts.show_post')
                        @endforeach

                    </div>
                    <div class="tab-pane fade" id="shared_files" role="tabpanel" aria-labelledby="nav-profile-tab">

                        @foreach($shared_files as $shared_file)
                            @include('library.show_shared_file')
                        @endforeach

                    </div>
                    <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="nav-contact-tab">

                        @foreach($questions as $question)
                            @include('question_answer.show_question')
                        @endforeach

                    </div>

                </div>

            @endisset


        </div>
    </div>

@endsection
