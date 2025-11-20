@extends('course.course')
@section('active_resources')
    active
@endsection
@section('tab_content')

    <div class="tab-content">
        <div class="tab-pane active" id="resources">

            @if (Auth::user()->can('teacher_access', $course) || Auth::user()->can('student_access', $course) )

                <div class="card bg-light">
                    <div class="card-body">
                        @foreach($course->resources as $resource)
                            <div class="card card_width_center">
                                <div class="card-body h6">
                                    {{$resource->title}}
                                    <span class="badge badge-warning  badge-pill font-weight-bold">{{$resource->file_type}}</span>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <a href="{{route('course.download_resource',['resource_id'=>$resource->id])}}" class="btn btn-success" role="button">
                                        {{__('text.Download')}}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            @else
                <div class="card">
                    <div class="card-body">
                        <div class="text-muted h4 text-center mt-5 mb-5">
                            {{__('text.You must first register to access course resources')}}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
