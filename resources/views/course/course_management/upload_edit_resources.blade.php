@extends('course.course_management.course_management')

@section('active_upload_edit_resources')
    active
@endsection

@section('manage_course')
    <div class="card">
        <div class="card-body">

            <table class="table table-bordered" style="font-size: 0.95rem;">
                <thead>
                <tr>
                    <th scope="col"colspan="2">{{__('text.resources')}}</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">
                        <a class="btn btn-primary btn-block" href="{{route('course.upload_resources',['course_id'=>$course->id])}}">
                            {{__('text.Upload')}}
                        </a>
                    </td>
                </tr>

                @foreach($course->resources as $resource)
                    <tr>
                        <td>
                            {{$resource->title}}
                            <span class="badge badge-pill badge-warning font-weight-bold">{{$resource->file_type}}</span>
                        </td>
                        <td width="200">
                            <div class="row">
                                <div class="col-sm-auto mb-1">
                                    <a class="btn btn-success btn-block"
                                       href="{{route('course.edit_resources',['course_id'=>$course->id,'resource_id'=>$resource->id])}}">
                                        {{__('text.Edit')}}
                                    </a>
                                </div>
                                <div class="col-sm-auto mb-1">
                                    <a class="btn btn-success btn-block"
                                       href="{{route('course.delete_resources',['course_id'=>$course->id,'resource_id'=>$resource->id])}}">
                                        {{__('text.Delete')}}
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>

@endsection
