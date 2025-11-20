<?php

namespace App\Http\Controllers;

use App\Course;
use App\Post;
use App\Question;
use App\SharedFile;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function public_start()
    {
        $user_count=User::count();
        $post_count=Post::count();
        $shared_file_count=SharedFile::count();
        $question_count=Question::count();
        $course_count=Course::count();
        return view('public_pages.start_page',compact('user_count','post_count','shared_file_count','question_count','course_count'));
    }


    public function index()
    {
        //return view('home');
    }

}
