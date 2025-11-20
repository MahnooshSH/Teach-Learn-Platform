<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharedFileVoteController extends Controller
{
    public function shared_file_up_vote(Request $request)
    {
        $user=Auth::user();
        $shared_file_id=$request->input('shared_file_id');

        if($user->shared_file_votes()->where('shared_file_id', $shared_file_id)->exists())
        {


            if($user->shared_file_votes()->where('shared_file_id', $shared_file_id)->where('vote',-1)->exists())
            {
                $user->shared_file_votes()->where('shared_file_id', $shared_file_id)->update(['vote'=>1]);

            }
            else
            {
                $user->shared_file_votes()->where('shared_file_id', $shared_file_id)->delete();
            }
        }
        else
        {

            $user->shared_file_votes()->create(['shared_file_id'=>$shared_file_id ,'vote'=>1]);
        }

    }

    public function shared_file_down_vote(Request $request)
    {
        $user=Auth::user();
        $shared_file_id=$request->input('shared_file_id');

        if($user->shared_file_votes()->where('shared_file_id', $shared_file_id)->exists())
        {


            if($user->shared_file_votes()->where('shared_file_id', $shared_file_id)->where('vote',1)->exists())
            {
                $user->shared_file_votes()->where('shared_file_id', $shared_file_id)->update(['vote'=>-1]);

            }
            else
            {
                $user->shared_file_votes()->where('shared_file_id', $shared_file_id)->delete();
            }
        }
        else
        {

            $user->shared_file_votes()->create(['shared_file_id'=>$shared_file_id ,'vote'=>-1]);
        }

    }
}
