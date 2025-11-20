<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerVoteController extends Controller
{
    public function answer_up_vote(Request $request)
    {
        $user=Auth::user();
        $answer_id=$request->input('answer_id');

        if($user->answer_votes()->where('answer_id', $answer_id)->exists())
        {


            if($user->answer_votes()->where('answer_id', $answer_id)->where('vote',-1)->exists())
            {
                $user->answer_votes()->where('answer_id', $answer_id)->update(['vote'=>1]);

            }
            else
            {
                $user->answer_votes()->where('answer_id', $answer_id)->delete();
            }
        }
        else
        {

            $user->answer_votes()->create(['answer_id'=>$answer_id ,'vote'=>1]);
        }

    }

    public function answer_down_vote(Request $request)
    {
        $user=Auth::user();
        $answer_id=$request->input('answer_id');

        if($user->answer_votes()->where('answer_id', $answer_id)->exists())
        {


            if($user->answer_votes()->where('answer_id', $answer_id)->where('vote',1)->exists())
            {
                $user->answer_votes()->where('answer_id', $answer_id)->update(['vote'=>-1]);

            }
            else
            {
                $user->answer_votes()->where('answer_id', $answer_id)->delete();
            }
        }
        else
        {

            $user->answer_votes()->create(['answer_id'=>$answer_id ,'vote'=>-1]);
        }
    }
}
