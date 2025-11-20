<div class="card mt-0">

    <div class="card-header d-flex justify-content-center sticky-tag-top">
        <div class="row">
            <div class="mr-3 mb-1 col-md-auto">
                <div class="tag_title text-center">
                    {{$tag->name}}
                </div>
            </div>
            <div class="media-body col-md-auto">

                <nav>
                    <div class="nav tag-nav mt-1" id="tag-nave" role="tablist">

                        <a class="nav-item nav-link h6 active" id="nav-courses" data-toggle="tab" href="#courses" role="tab" aria-controls="nav-home" aria-selected="true">
                            {{$tag->courses()->count()}} {{str_plural('course',$tag->courses()->count())}}
                        </a>


                        <a class="nav-item nav-link h6" id="nav-posts" data-toggle="tab" href="#posts" role="tab" aria-controls="nav-profile" aria-selected="false">
                            {{$tag->posts()->count()}} {{str_plural('post',$tag->posts()->count())}}
                        </a>


                        <a class="nav-item nav-link h6" id="nav-shared-files" data-toggle="tab" href="#shared_files" role="tab" aria-controls="nav-profile" aria-selected="false">
                            {{$tag->shared_files()->count()}} {{str_plural('shared_file',$tag->shared_files()->count())}}
                        </a>

                        <a class="nav-item nav-link h6" id="nav-questions" data-toggle="tab" href="#questions" role="tab" aria-controls="nav-profile" aria-selected="false">
                            {{$tag->questions()->count()}} {{str_plural('question',$tag->questions()->count())}}
                        </a>

                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="card-body" style="background-color:whitesmoke">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="nav-courses">
                <div class="row">
                    @foreach($tag->courses as $course)
                        @include('course.show_courses')
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="nav-posts">
                @foreach($tag->posts as $post)
                    @include('posts.show_post')
                @endforeach
            </div>
            <div class="tab-pane fade" id="shared_files" role="tabpanel" aria-labelledby="nav-shared-files">
                @foreach($tag->shared_files as $shared_file)
                    @include('library.show_shared_file')
                @endforeach
            </div>
            <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="nav-questions">
                @foreach($tag->questions as $question)
                    @include('question_answer.show_question')
                @endforeach
            </div>
        </div>
    </div>

</div>
