<?php

namespace App\Http\Controllers;

use App\Course;
use App\Quiz;
use App\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function create(Request $request,$course_id,$quiz_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz = Quiz::findOrFail($quiz_id);
        $this->authorize('teacher_access', $course);

        $request->validate([
            'question'=>'required|string|max:200',
            'answer1'=>'required|string|max:100',
            'answer2'=>'required|string|max:100',
            'answer3'=>'required|string|max:100',
            'answer4'=>'required|string|max:100',
            'true_answer'=>'required|numeric|min:1|max:4',
        ]);
        $quiz->quiz_questions()->create($request->all());
    }

    public function update(Request $request,$course_id,$quiz_question_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz_question = QuizQuestion::findOrFail($quiz_question_id);
        $this->authorize('teacher_access', $course);

        $request->validate([
            'question'=>'required|string|max:200',
            'answer1'=>'required|string|max:100',
            'answer2'=>'required|string|max:100',
            'answer3'=>'required|string|max:100',
            'answer4'=>'required|string|max:100',
            'true_answer'=>'required|numeric|min:1|max:4',
        ]);
        $quiz_question->update($request->all());
    }

    public function delete($course_id,$quiz_question_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz_question = QuizQuestion::findOrFail($quiz_question_id);
        $this->authorize('teacher_access', $course);

        $quiz_question->delete();
    }
}
