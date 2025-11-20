<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Quiz;
use App\Resource;
use App\TutorialVideo;
use Illuminate\Http\Request;

class CourseManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function edit_course_info($id)
    {
        $course=Course::findOrFail($id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.edit_course_info',compact('course'));
    }

    public function manage_course_content($id)
    {
        $course=Course::findOrFail($id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.manage_course_content',compact('course'));
    }

    public function upload_edit_resources($id)
    {
        $course=Course::findOrFail($id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.upload_edit_resources',compact('course'));
    }
    public function manage_students($id)
    {
        $course=Course::findOrFail($id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.manage_students',compact('course'));
    }

    public function create_new_lesson($id)
    {
        $course=Course::findOrFail($id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.create_new_lesson',compact('course'));
    }

    public function upload_tutorial_video($course_id ,$lesson_id)
    {
        $course=Course::findOrFail($course_id);

        $this->authorize('teacher_access',$course );
        $lesson=Lesson::findOrFail($lesson_id);

        return view('course.course_management.upload_tutorial_video',compact('course','lesson'));
    }

    public function create_new_quiz($course_id ,$lesson_id)
    {
        $course=Course::findOrFail($course_id);

        $this->authorize('teacher_access',$course );
        $lesson=Lesson::findOrFail($lesson_id);

        return view('course.course_management.create_new_quiz',compact('course','lesson'));
    }

    public function make_quiz($course_id ,$quiz_id)
    {
        $course=Course::findOrFail($course_id);

        $this->authorize('teacher_access',$course );
        $quiz=Quiz::findOrFail($quiz_id);

        return view('course.course_management.make_quiz',compact('course','quiz'));
    }

    public function edit_lesson($course_id ,$lesson_id)
    {
        $course=Course::findOrFail($course_id);
        $lesson=Lesson::findOrFail($lesson_id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.edit_lesson',compact('course','lesson'));
    }

    public function edit_tutorial_video($course_id ,$tutorial_video_id)
    {
        $course=Course::findOrFail($course_id);
        $tutorial_video=TutorialVideo::findOrFail($tutorial_video_id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.edit_tutorial_video',compact('course','tutorial_video'));
    }

    public function upload_resources($course_id)
    {
        $course=Course::findOrFail($course_id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.upload_resources',compact('course'));
    }
    public function edit_resources($course_id,$resource_id)
    {
        $course=Course::findOrFail($course_id);
        $resource=Resource::findorFail($resource_id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.edit_resources',compact('course','resource'));
    }


}
