<?php

namespace App\Http\Controllers;

use App\Course;
use App\Quiz;
use App\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAnswerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function take_quiz($course_id,$quiz_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz = Quiz::findOrFail($quiz_id);
        $this->authorize('student_access', $course);

        $student_id=Auth::user()->id;

        if(QuizAnswer::where('student_id',$student_id)->where('quiz_id',$quiz_id)->doesntExist())
        {
            $answer=serialize([]);
            $quiz->quiz_answers()->create(['student_id'=>$student_id,'answer'=>$answer]);
        }

        return view('course.take_quiz',compact('course','quiz'));
    }


    public function quiz(Request $request,$course_id,$quiz_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz = Quiz::findOrFail($quiz_id);
        $this_edu_session_id=$quiz->edu_session->id;
        $this->authorize('student_access', $course);

        $answer = serialize($request->except('_token'));

        $true_count=0;
        $wrong_count=0;
        $unanswered_count=0;
        $all_question_count=$quiz->quiz_questions->count();

        foreach ($quiz->quiz_questions as $quiz_question)
        {
            if ($request->has($quiz_question->id)) {

                if($request->input($quiz_question->id) == $quiz_question->true_answer)
                {
                    $true_count=$true_count+1;
                }
                else
                {
                    $wrong_count=$wrong_count+1;
                }


            }
            else{

                $unanswered_count=$unanswered_count+1;
            }

        }
        if($all_question_count!=0)
        {
            $result=($true_count/$all_question_count)*100;
        }
        else
        {
            $result=0;
        }



        if($quiz->quiz_answers()->where('student_id',Auth::user()->id)->exists()) {


            if($quiz->time_is_limited==1 )
            {
                $quiz_answer=$quiz->quiz_answers()->where('student_id',Auth::user()->id)->first();
                $start_time=\Carbon\Carbon::parse($quiz_answer->created_at);
                $now=\Carbon\Carbon::now();
                $time_diff=($start_time->diffInSeconds($now))-10;
                $limit_time=($quiz->limitation_time)*60;
                if($limit_time>=$time_diff)
                {
                    $quiz->quiz_answers()->where('student_id',Auth::user()->id)
                        ->update([
                            'answer' => $answer,
                            'true_count'=>$true_count,
                            'wrong_count'=>$wrong_count,
                            'unanswered_count'=>$unanswered_count,
                            'result'=>$result
                        ]);
                }
                else
                {
                    if($all_question_count!=0)
                    {
                        $result=($quiz_answer->true_count/$all_question_count)*100;
                    }
                    else
                    {
                        $result=0;
                    }
                    $quiz->quiz_answers()->where('student_id',Auth::user()->id)
                        ->update([
                            'result'=>$result
                        ]);
                }
            }
            else
            {
                $quiz->quiz_answers()->where('student_id',Auth::user()->id)
                    ->update([
                        'answer' => $answer,
                        'true_count'=>$true_count,
                        'wrong_count'=>$wrong_count,
                        'unanswered_count'=>$unanswered_count,
                        'result'=>$result
                    ]);
            }
        }


        return redirect(route('course.show_quiz',
            ['course_id'=>$course_id,'edu_session_id'=>$this_edu_session_id,'quiz_id'=>$quiz_id]
        ));
    }

    public function save_per_minute(Request $request,$course_id,$quiz_id)
    {
        $course = Course::findOrFail($course_id);
        $quiz = Quiz::findOrFail($quiz_id);
        $this->authorize('student_access', $course);

        $answer = serialize($request->except('_token'));

        $true_count=0;
        $wrong_count=0;
        $unanswered_count=0;

        foreach ($quiz->quiz_questions as $quiz_question)
        {
            if ($request->has($quiz_question->id)) {

                if($request->input($quiz_question->id) == $quiz_question->true_answer)
                {
                    $true_count=$true_count+1;
                }
                else
                {
                    $wrong_count=$wrong_count+1;
                }


            }
            else{

                $unanswered_count=$unanswered_count+1;
            }

        }

        if($quiz->quiz_answers()->where('student_id',Auth::user()->id)->exists()) {


            if($quiz->time_is_limited==1 )
            {
                $quiz_answer=$quiz->quiz_answers()->where('student_id',Auth::user()->id)->first();
                $start_time=\Carbon\Carbon::parse($quiz_answer->created_at);
                $now=\Carbon\Carbon::now();
                $time_diff=($start_time->diffInSeconds($now))-10;
                $limit_time=($quiz->limitation_time)*60;
                if($limit_time>=$time_diff)
                {
                    $quiz->quiz_answers()->where('student_id',Auth::user()->id)
                        ->update([
                            'answer' => $answer,
                            'true_count'=>$true_count,
                            'wrong_count'=>$wrong_count,
                            'unanswered_count'=>$unanswered_count
                        ]);
                }
            }
            else
            {
                $quiz->quiz_answers()->where('student_id',Auth::user()->id)
                    ->update([
                        'answer' => $answer,
                        'true_count'=>$true_count,
                        'wrong_count'=>$wrong_count,
                        'unanswered_count'=>$unanswered_count
                    ]);
            }
        }
    }
}
