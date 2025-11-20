<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }


    public function create(Request $request,$course_id)
    {


        $request->validate([
            'question'=>'required|string|max:1500',
        ]);

        $question=$request->input('question');

        Auth::user()->course_questions()->create(['question'=>$question,'course_id'=>$course_id]);


    }
}
