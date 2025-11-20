<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Quiz;
use App\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function create(Request $request, $course_id, $lesson_id)
    {
        $course = Course::findOrFail($course_id);
        $lesson = Lesson::findOrFail($lesson_id);
        $this->authorize('teacher_access', $course);


        if ($request->has('time_is_limited')) {

            $request->validate([
                'title' => 'required|string|max:60',
                'description' => 'nullable|string|max:1000',
                'time_limitation' => 'required|numeric|min:1|max:60',
            ]);


            $edu_session = $course->edu_sessions()->create(['lesson_id' => $lesson->id, 'session_type' => 'quiz']);

            $quiz = $edu_session->quiz()->create(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'limitation_time' => $request->input('time_limitation'),
                    'time_is_limited' => 1
                ]
            );

        } else {

            $request->validate([
                'title' => 'required|string|max:60',
                'description' => 'nullable|string|max:1000',
                'time_limitation' => 'nullable|numeric|min:1|max:60',
            ]);

            $edu_session = $course->edu_sessions()->create(['lesson_id' => $lesson->id, 'session_type' => 'quiz']);

            $quiz = $edu_session->quiz()->create(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'time_is_limited' => 0
                ]
            );

        }

        return redirect(route('course.make_quiz', ['course_id' => $course->id, 'quiz_id' => $quiz->id]));

    }


    public function update(Request $request, $course_id, $quiz_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz = Quiz::findOrFail($quiz_id);
        $this->authorize('teacher_access', $course);


        if ($request->has('time_is_limited')) {

            $request->validate([
                'title' => 'required|string|max:60',
                'description' => 'nullable|string|max:1000',
                'time_limitation' => 'required|numeric|min:1|max:60',
            ]);


            $quiz->update(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'limitation_time' => $request->input('time_limitation'),
                    'time_is_limited' => 1
                ]
            );

        } else {

            $request->validate([
                'title' => 'required|string|max:60',
                'description' => 'nullable|string|max:1000',
                'time_limitation' => 'nullable|numeric|min:1|max:60',
            ]);

            $quiz->update(
                [
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'limitation_time' => null,
                    'time_is_limited' => 0
                ]
            );

        }


    }


    public function delete($course_id, $quiz_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz = Quiz::findOrFail($quiz_id);
        $this->authorize('teacher_access', $course);

        $quiz->edu_session->delete();

        return redirect(route('course.manage_course_content',['id'=>$course->id]));
    }





    public function quiz_results($course_id,$quiz_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz = Quiz::findOrFail($quiz_id);
        $this->authorize('teacher_access', $course);
        return view('course.quiz_results',compact('course','quiz'));
    }


}
