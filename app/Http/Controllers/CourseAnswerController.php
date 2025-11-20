<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }


    public function create(Request $request,$course_question_id)
    {


        $request->validate([
            'answer'=>'required|string|max:1500',
        ]);

        $answer=$request->input('answer');

        Auth::user()->course_answers()->create(['answer'=>$answer,'course_question_id'=>$course_question_id]);


    }
}
