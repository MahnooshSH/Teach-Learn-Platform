<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function like_post(Request $request)
    {

        $user=Auth::user();
        $post_id = $request->input('post_id');

        if($user->post_likes()->where('post_id', $post_id)->exists())
        {
            $user->post_likes()->where('post_id', $post_id)->delete();
        }
        else
        {
            $user->post_likes()->firstOrCreate(['post_id'=>$post_id]);
        }

    }
}
