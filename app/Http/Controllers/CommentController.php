<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add_comment(Request $request)
    {
        $request->validate([
            'content'=>'required|string|max:1000',
        ]);

        $content = $request->input('content');
        $post_id = $request->input('post_id');

        Auth::user()->comments()->create(['content'=>$content,'post_id'=>$post_id]);


    }
}
