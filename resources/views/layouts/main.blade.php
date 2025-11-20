<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teach & Learn</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!--ajax post csrf -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/layout.css')}}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{asset('css/my.css')}}" id="theme-stylesheet">

    <!-- tags input -->
    <link rel="stylesheet" href="{{asset('tagsinput/bootstrap-tagsinput.css')}}">


</head>
<body>
<!-- Side Navbar -->
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center"><img src="{{asset('storage/profile_images/'.Auth::user()->profile_image)}}" alt="person" class="img-fluid rounded-circle">
                <h2 class="h5">{{ Auth::user()->first_name}} {{Auth::user()->last_name }}</h2>
            </div>

        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">

                <!-- <li  ><a href=""> <i class="fas fa-home"></i>__('text.Home')</a></li> -->

                <li @yield('active_profile')><a href="{{route('profile.user_profile')}}"> <i class="fas fa-user"></i>{{__('text.Profile')}}</a></li>
                <li @yield('active_posts')><a href="{{route('posts.following_posts')}}"> <i class="fas fa-mail-bulk"></i>{{__('text.Posts')}}</a></li>
                <li @yield('active_library')><a href="{{route('library.following_shared_files')}}"> <i class="fas fa-folder"></i>{{__('text.Library')}}</a></li>
                <li @yield('active_question_answer')><a href="{{route('question_answer.following_questions')}}"> <i class="fas fa-comments"></i>{{__('text.Q & A')}}</a></li>
                <li @yield('active_learning')><a href="{{route('learning.top_courses')}}"> <i class="fas fa-chalkboard"></i>{{__('text.Learning')}}</a></li>
                <li @yield('active_teaching')><a href="{{route('teaching.my_courses_as_teacher')}}"> <i class="fas fa-chalkboard-teacher"></i>{{__('text.Teaching')}}</a></li>
                <li @yield('active_search')><a href="{{route('search.search')}}"> <i class="fas fa-search"></i>{{__('text.Search')}}</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="page">
    <!-- navbar-->
    <header class="header">
        <nav class="navbar fixed-top">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header"><a id="toggle-btn"  href="#" class="menu-btn"><i class="fas fa-list-ul fa-2x"></i></a><a href="{{route('start_page')}}" class="ml-3">
                            <div class="brand-text d-none d-md-inline-block"><strong >Teach & Learn</strong></div></a></div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                        <li class="mr-2">
                            <a href="{{ url('locale/en') }}" class="btn btn-outline-primary" >EN</a>
                        </li>
                        <li class="mr-3">
                            <a href="{{ url('locale/fa') }}" class="btn btn-outline-primary">FA</a>
                        </li>
                        <!-- Log out-->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="d-none d-sm-inline-block">{{__('text.Logout')}}</span><i class="fas fa-sign-out-alt"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="main-footer">
        <div class="container">
            <div class="justify-content-between">
                <div class="">
                    <p>Design by mahnoosh shokri</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- JavaScript files-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Main File-->
<script src="{{asset('js/front.js')}}"></script>
<!-- tags input -->
<script src="{{asset('tagsinput/bootstrap-tagsinput.js')}}"></script>

<!-- my_js-->
<script src="{{asset('js/my.js')}}"></script>
<script src="{{asset('js/extra.js')}}"></script>

</body>
</html>
