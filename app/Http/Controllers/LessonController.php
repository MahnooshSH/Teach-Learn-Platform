<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function create(Request $request,$id)
    {
        $course=Course::findOrFail($id);
        $this->authorize('teacher_access',$course);

        $request->validate([
            'lesson_number'=>'required|numeric|max:100',
            'title'=>'required|string|max:80',
            'description'=>'nullable|string|max:1000',
        ]);

        $course->lessons()->create($request->only('lesson_number','title','description'));

        return redirect(route('course.manage_course_content',['id'=>$course->id]));
    }

    public function update(Request $request,$course_id,$lesson_id)
    {
        $course=Course::findOrFail($course_id);
        $lesson=Lesson::findOrFail($lesson_id);
        $this->authorize('teacher_access',$course);

        $request->validate([
            'lesson_number'=>'required|numeric|max:100|unique:lessons,lesson_number,'.$lesson_id.'',
            'title'=>'required|string|max:80',
            'description'=>'nullable|string|max:1000',
        ]);

        $lesson->update($request->only('lesson_number','title','description'));

        return redirect(route('course.manage_course_content',['id'=>$course->id]));
    }

    public function delete($course_id,$lesson_id)
    {
        $course=Course::findOrFail($course_id);
        $lesson=Lesson::findOrFail($lesson_id);
        $this->authorize('teacher_access',$course);

        $lesson->delete();

        return redirect(route('course.manage_course_content',['id'=>$course->id]));
    }

}
