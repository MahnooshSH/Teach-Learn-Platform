<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\TutorialVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorialVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function create(Request $request,$course_id,$lesson_id)
    {
        $course=Course::findOrFail($course_id);
        $lesson=Lesson::findOrFail($lesson_id);
        $this->authorize('teacher_access',$course);

        $request->validate([
            'title'=>'required|string|max:60',
            'tutorial_video'=>'required|file|mimes:mp4|max:51350',
        ]);

        if ($request->hasFile('tutorial_video')) {


            $path=$request->file('tutorial_video')->store('tutorial_videos','public');
            $video_type=$request->file('tutorial_video')->getMimeType();

            $title=$request->input('title');

            $edu_session=$course->edu_sessions()->create(['lesson_id'=>$lesson->id,'session_type'=>'tutorial_video']);

            $edu_session->tutorial_video()->create(['title'=>$title,'tutorial_video'=>$path,'video_type'=>$video_type]);


        }
        return redirect(route('course.manage_course_content',['id'=>$course->id]));

    }


    public function update(Request $request,$course_id,$tutorial_video_id)
    {
        $course=Course::findOrFail($course_id);
        $tutorial_video=TutorialVideo::findOrFail($tutorial_video_id);
        $this->authorize('teacher_access',$course);

        $request->validate([
            'title'=>'required|string|max:60',
            'tutorial_video'=>'nullable|file|mimes:mp4|max:51350',
        ]);

        $title=$request->input('title');

        if ($request->hasFile('tutorial_video')) {

            $old_path=$tutorial_video->tutorial_video;

            $path=$request->file('tutorial_video')->store('tutorial_videos','public');
            $video_type=$request->file('tutorial_video')->getMimeType();


            $tutorial_video->update(['title'=>$title,'tutorial_video'=>$path,'video_type'=>$video_type]);

            if(is_file((storage_path('app/public/'.$old_path))))
            {
                Storage::disk('public')->delete($old_path);
            }


        }
        else
        {
            $tutorial_video->update(['title'=>$title]);
        }

        return redirect(route('course.manage_course_content',['id'=>$course->id]));

    }

    public function delete($course_id,$tutorial_video_id)
    {
        $course=Course::findOrFail($course_id);
        $tutorial_video=TutorialVideo::findOrFail($tutorial_video_id);
        $this->authorize('teacher_access',$course);

        $old_path=$tutorial_video->tutorial_video;
        if(is_file((storage_path('app/public/'.$old_path))))
        {
            Storage::disk('public')->delete($old_path);
        }

        $tutorial_video->edu_session->delete();
        return redirect(route('course.manage_course_content',['id'=>$course->id]));
    }
}
