<?php

namespace App\Http\Controllers;

use App\Course;
use App\Post;
use App\Question;
use App\SharedFile;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }


    public function search_page()
    {
        return view('search.search_all');
    }

    public function posts_search()
    {
        return view('search.posts_search');
    }
    public function courses_search()
    {
        return view('search.courses_search');
    }
    public function library_search()
    {
        return view('search.library_search');
    }
    public function qa_search()
    {
        return view('search.qa_search');
    }
    public function users_search()
    {
        return view('search.users_search');
    }
    public function tags_search()
    {
        return view('search.tags_search');
    }



    public function all_search(Request $request)
    {
        $request->validate([
            'search'=>'required|string|max:300',
        ]);

        $search=$request->input('search');
        $search_items=explode(' ',$search);


        //search posts
        $posts=new Post();
        foreach ($search_items as $item)
        {
            $posts=$posts->where('post_content','like','%'.$item.'%');
        }
        $posts=$posts->get();

        //search questions
        $questions=new Question();
        foreach ($search_items as $item)
        {
            $questions=$questions->where('question','like','%'.$item.'%');
        }
        $questions=$questions->get();

        //search shared_files
        $shared_files=new SharedFile();
        foreach ($search_items as $item)
        {
            $shared_files=$shared_files->where('title','like','%'.$item.'%');
        }
        $shared_files=$shared_files->get();

        //search courses
        $courses=new Course();
        foreach ($search_items as $item)
        {
            $courses=$courses->where('title','like','%'.$item.'%');
        }
        $courses=$courses->get();



        return view('search.search_all',compact('search','posts','questions','shared_files','courses'));


    }

    public function live_search_user(Request $request)
    {
        $search_user=$request->input('search_user');
        $search_user_words=explode(" ",$search_user);
        if($search_user != null)
        {
            $users=User::where('username','like','%'.$search_user.'%')
                ->orWhere(function ($query) use ($search_user_words) {
                    foreach ($search_user_words as $word)
                    {
                        $query->Where(function ($query) use ($word)
                        {
                            $query->Where('first_name','like','%'.$word.'%')
                                ->orWhere('last_name','like','%'.$word.'%');
                        });
                    }
                })
                ->orWhere('first_name','like','%'.$search_user.'%')
                ->orWhere('last_name','like','%'.$search_user.'%')
                ->limit(20)->get();
            $show_users='<ul class="list-group list-group-flush dropdown-menu ml-3 live_search">';
            foreach ($users as $user)
            {
                $show_users.='<a href="/user_panel/users_search/search_user?search_user='.$user->username.'"><li class="list-group-item list-group-item-action">
                <div class="media">
                <img class="rounded-circle" src="'.asset('/storage/profile_images/'.$user->profile_image).'"
                                 width="40px" height="40px" alt="student_profile">
                <div class="media-body ml-3 text-small"><div class="font-weight-bold">'.$user->username.'</div><div class="text-muted">'.$user->first_name.' '.$user->last_name.'</div>
                </li></a>';


            }
            $show_users.='</ul>';
        }
        else
        {
            $show_users='';
        }


        return $show_users;

    }



    public function live_search_tag(Request $request)
    {
        $search_tag=$request->input('search_tag');
        if($search_tag != null)
        {
            $tags=Tag::where('name','like','%'.$search_tag.'%')->limit(20)->get();
            $show_tags='<ul class="list-group list-group-flush  dropdown-menu ml-3 live_search">';
            foreach ($tags as $tag)
            {
                $show_tags.='<a href="/user_panel/tags_search/search_tag?search_tag='.$tag->name.'"><li class="list-group-item list-group-item-action">'.$tag->name.'</li></a>';
            }
            $show_tags.='</ul>';
        }
        else
        {
            $show_tags='';
        }


        return $show_tags;

    }


}
