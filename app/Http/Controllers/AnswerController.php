<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function create_answer(Request $request)
    {

        $request->validate([
           'answer'=>'required|string|max:3000'
        ]);

        $answer=$request->input('answer');
        $question_id=$request->input('question_id');

        Auth::user()->answers()->create(['answer'=>$answer,'question_id'=>$question_id]);

    }
}
