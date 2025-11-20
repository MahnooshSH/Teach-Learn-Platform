<?php

namespace App\Http\Controllers;

use App\Course;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate')->except('download');
    }

    public function create(Request $request,$course_id)
    {
        $course = Course::findOrFail($course_id);
        $this->authorize('teacher_access', $course);

        $request->validate([
            'title'=>'required|string|max:1500',
            'file'=>'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',

        ]);

        $title=$request->input('title');


        if ($request->hasFile('file'))
        {


            $path = $request->file('file')->store('course_resources_files', 'public');
            $file_type = $request->file('file')->getClientOriginalExtension();

            $course->resources()->create(['title' => $title, 'file' => $path, 'file_type' => $file_type]);

        }


        return redirect(route('course.upload_edit_resources',['id'=>$course_id]));
    }


    public function update(Request $request,$course_id,$resource_id)
    {
        $course = Course::findOrFail($course_id);
        $resource=Resource::findorFail($resource_id);

        $this->authorize('teacher_access', $course);

        $request->validate([
            'title'=>'required|string|max:1500',
            'file'=>'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',

        ]);

        $title=$request->input('title');

        if ($request->hasFile('file')) {

            $old_path=$resource->file;


            $path = $request->file('file')->store('course_resources_files', 'public');
            $file_type = $request->file('file')->getClientOriginalExtension();

            $resource->update(['title' => $title, 'file' => $path, 'file_type' => $file_type]);

            if(is_file((storage_path('app/public/'.$old_path))))
            {
                Storage::disk('public')->delete($old_path);
            }
        }
        else
        {
            $resource->update(['title' => $title]);
        }


        return redirect(route('course.upload_edit_resources',['id'=>$course_id]));
    }

    public function delete($course_id,$resource_id)
    {
        $course = Course::findOrFail($course_id);
        $resource=Resource::findorFail($resource_id);

        $this->authorize('teacher_access', $course);

        $old_path=$resource->file;
        if(is_file((storage_path('app/public/'.$old_path))))
        {
            Storage::disk('public')->delete($old_path);
        }

        $resource->delete();

        return redirect(route('course.upload_edit_resources',['id'=>$course_id]));
    }

    public function download($resource_id)
    {
        $resource=Resource::findOrFail($resource_id);
        $pathToFile="storage/".$resource->file;
        $name=$resource->title.'.'.$resource->file_type;
        return response()->download($pathToFile, $name);
    }
}
