@extends('layouts.public_layout')
@section('content')
    <div class="">


        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="{{asset('images/slide_a.png')}}" alt="First slide">
                    <div class="container">
                        <div class="carousel-caption carousel-caption_a text-left mt-5">
                            <h1>Create a personal profile</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="second-slide" src="{{asset('images/slide_e.jpg')}}" alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption carousel-caption_b text-left">
                            <h1>Share your knowledge</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="third-slide" src="{{asset('images/slide_h.jpg')}}" alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption carousel-caption_c text-left">
                            <div class="row">
                                <div class="col-8"></div>
                                <div class="col-4">
                                    <h1>Share your articles, books, and other documents with others</h1>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="forth-slide" src="{{asset('images/slide_f.jpg')}}" alt="forth slide">
                    <div class="container">
                        <div class="carousel-caption carousel-caption_d">
                            <h1>Ask your questions</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="fifth-slide" src="{{asset('images/slide_g.jpg')}}" alt="fifth slide">
                    <div class="container">
                        <div class="carousel-caption carousel-caption_f">
                            <h1>Create your course and Teach what you know</h1>
                        </div>
                    </div>
                </div>


            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <!-- Marketing messaging and featurettes
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing mt-5">

            <!-- Three columns of text below the carousel -->
            <div class="row d-flex justify-content-between text-center">
                <div class="col-lg-2">
                    <img class="rounded-circle" src="{{asset('images/userc.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                    <h2 class="mt-4">{{$user_count}} Users</h2>

                </div><!-- /.col-lg-4 -->
                <div class="col-lg-2">
                    <img class="rounded-circle" src="{{asset('images/postc.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                    <h2 class="mt-4">{{$post_count}} Posts</h2>

                </div><!-- /.col-lg-4 -->
                <div class="col-lg-2">
                    <img class="rounded-circle" src="{{asset('images/coursecount.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                    <h2 class="mt-4">{{$course_count}} Courses</h2>

                </div>
                <div class="col-lg-2">
                    <img class="rounded-circle" src="{{asset('images/sharec_b.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                    <h2 class="mt-4">{{$shared_file_count}} Shared Files</h2>

                </div>
                <div class="col-lg-2">
                    <img class="rounded-circle" src="{{asset('images/qac.jpg')}}" alt="Generic placeholder image" width="140" height="140">
                    <h2 class="mt-4">{{$question_count}} Questions</h2>

                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-6">
                    <h2 class="featurette-heading">Learning</h2>
                    <p class="lead">
                        You can start learning with an account. You can use posts and files that others share. Also, ask if you have questions, other users can answer your question. Most importantly, you can enroll in courses and use their educational content.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="featurette-image img-fluid mx-auto rounded-pill" src="{{asset('images/start_learn.jpg')}}" alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-6 order-md-2">
                    <h2 class="featurette-heading">Teaching</h2>
                    <p class="lead">
                        If you have knowledge and expertise, you can teach it to others. You can share your knowledge in posts. You can also share your articles, books, and other documents with others. If you know the answer to the questions, answer them. In addition, you are able to create a course where you can create training sessions and manage the course.
                    </p>
                </div>
                <div class="col-md-6 order-md-1">
                    <img class="featurette-image img-fluid rounded-pill mx-auto" src="{{asset('images/start_teach.jpg')}}" alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-6">
                    <h2 class="featurette-heading">Make Quizzes</h2>
                    <p class="lead">
                        The course instructor can make a quiz. Quiz time can be limited or limited. The course students can take part in these quizzes. The course instructor is able to view the results of each student's quiz with detail.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="featurette-image img-fluid mx-auto rounded-pill" src="{{asset('images/start_quiz.jpg')}}" alt="Generic placeholder image">
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->



    </div>
    @endsection
