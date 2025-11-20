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
<div class="public_page new_b_book">
    <!-- navbar-->
    <header class="header">
        <nav class="navbar fixed-top">
            <div class="container">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header"><a href="{{route('start_page')}}" class="">
                            <div class="brand-text d-none d-md-inline-block"><strong >Teach & Learn</strong></div></a></div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="fas fa-caret-down"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{route('profile.user_profile')}}">
                                        User Panel
                                    </a>
                                </div>
                            </li>
                        @endguest
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

<!-- my js-->
<script src="{{asset('js/my.js')}}"></script>
<script src="{{asset('js/extra.js')}}"></script>

</body>
</html>
