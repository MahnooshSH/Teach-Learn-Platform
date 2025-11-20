<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionVoteController extends Controller
{
    public function question_up_vote(Request $request)
    {
        $user=Auth::user();
        $question_id=$request->input('question_id');

        if($user->question_votes()->where('question_id', $question_id)->exists())
        {


            if($user->question_votes()->where('question_id', $question_id)->where('vote',-1)->exists())
            {
                $user->question_votes()->where('question_id', $question_id)->update(['vote'=>1]);

            }
            else
            {
                $user->question_votes()->where('question_id', $question_id)->delete();
            }
        }
        else
        {

            $user->question_votes()->create(['question_id'=>$question_id ,'vote'=>1]);
        }

    }

    public function question_down_vote(Request $request)
    {
        $user=Auth::user();
        $question_id=$request->input('question_id');

        if($user->question_votes()->where('question_id', $question_id)->exists())
        {


            if($user->question_votes()->where('question_id', $question_id)->where('vote',1)->exists())
            {
                $user->question_votes()->where('question_id', $question_id)->update(['vote'=>-1]);

            }
            else
            {
                $user->question_votes()->where('question_id', $question_id)->delete();
            }
        }
        else
        {
            $user->question_votes()->create(['question_id'=>$question_id ,'vote'=>-1]);
        }
    }
}
