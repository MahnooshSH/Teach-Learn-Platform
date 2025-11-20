@extends('course.course')
@section('active_course_management')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="course_management">

            <div class="row">
                <div class="col-sm-2 mb-3" >
                    <ul class="nav nav-tabs sticky-side-menu-top nav-justified flex-column">
                        <li class="nav-item list-group-item">
                            <a class="nav-link @yield('active_edit_course_info')" href="{{route('course.edit_course_info',['id'=>$course->id])}}">
                                {{__('text.Edit Course Info')}}
                            </a>
                        </li>
                        <li class="nav-item list-group-item">
                            <a class="nav-link @yield('active_manage_course_content')" href="{{route('course.manage_course_content',['id'=>$course->id])}}">
                                {{__('text.Manage Course Content')}}
                            </a>
                        </li>
                        <li class="nav-item list-group-item">
                            <a class="nav-link @yield('active_upload_edit_resources')" href="{{route('course.upload_edit_resources',['id'=>$course->id])}}">
                                {{__('text.Upload / Edit Resources')}}
                            </a>
                        </li>
                        <li class="nav-item list-group-item">
                            <a class="nav-link @yield('active_manage_students')" href="{{route('course.manage_students',['id'=>$course->id])}}">
                                {{__('text.Manage Students')}}
                            </a>
                        </li>


                    </ul>
                </div>
                <div class="col-sm-10">
                    <div>
                        @yield('manage_course')
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
