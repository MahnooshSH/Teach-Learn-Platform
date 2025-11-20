<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }

    public function create(Request $request)
    {

        $request->validate([
            'post_content'=>'required|string|max:5000',
            'post_file'=>'nullable|file|mimes:jpg,jpeg,png,mp4|max:30720',
            'tags.*'=>'nullable|string|alpha_dash|max:50'
        ]);

        $user=Auth::user();
        $post_content=$request->input('post_content');

        $tags=$request->input('tags');


        if ($request->hasFile('post_file')) {


            $path=$request->file('post_file')->store('post_files','public');
            $post_file_type=$request->file('post_file')->getMimeType();

            $post=$user->posts()->create(['post_content' => $post_content,'post_file' => $path,'post_file_type' => $post_file_type]);
        }
        else
        {
            $post=$user->posts()->create(['post_content' => $post_content]);

        }

        if($request->has('tags'))
        {
            foreach ($tags as $tag)
            {
                $tag_saved=Tag::firstOrCreate(['name' => $tag]);
                $tag_id=$tag_saved->id;
                $post->tags()->attach($tag_id);
            }
        }



        return redirect(route('posts.my_posts'));

    }


    public function update(Request $request,$id)
    {
        $post=Post::findOrFail($id);
        $this->authorize('update', $post);

        $request->validate([
            'post_content'=>'required|string|max:5000',
            'post_file'=>'nullable|file|mimes:jpg,jpeg,png,mp4|max:30720',
            'tags.*'=>'nullable|string|alpha_dash|max:50'
        ]);

        $user=Auth::user();
        $post_content=$request->input('post_content');

        $tags=$request->input('tags');

        if ($request->hasFile('post_file')) {

            $old_path=$post->post_file;


            $path=$request->file('post_file')->store('post_files','public');
            $post_file_type=$request->file('post_file')->getMimeType();

            $post->update(['post_content' => $post_content,'post_file' => $path,'post_file_type' => $post_file_type]);
            if(is_file((storage_path('app/public/'.$old_path))))
            {
                Storage::disk('public')->delete($old_path);
            }
        }

        else if($request->input('delete_file')=='1')
        {
            $old_path=$post->post_file;

            $post->update(['post_content' => $post_content,'post_file' => null,'post_file_type' => 'no_file' ]);
            if(is_file((storage_path('app/public/'.$old_path))))
            {
                Storage::disk('public')->delete($old_path);
            }

        }
        else
        {
            $post->update(['post_content' => $post_content]);
        }


        if($request->has('tags'))
        {
            $tag_id=array();
            foreach ($tags as $tag)
            {
                $tag_saved=Tag::firstOrCreate(['name' => $tag]);
                array_push($tag_id,$tag_saved->id);



            }
            $post->tags()->sync($tag_id);
        }
        else
        {
            $post->tags()->detach();
        }



        return redirect(route('posts.my_posts'));

    }

    public function delete($id)
    {
        $post=Post::findOrFail($id);
        $this->authorize('delete', $post);

        $old_path=$post->post_file;

        if(is_file((storage_path('app/public/'.$old_path))))
        {
            Storage::disk('public')->delete($old_path);
        }

        $post->delete();
        return redirect(route('posts.my_posts'));
    }

    public function following_posts()
    {
        $following=Auth::user()->following;
        $following_id=array();
        foreach ($following as $item)
        {
            array_push($following_id,$item->id);
        }

        $posts=Post::whereIn('user_id', $following_id)->OrderBy('created_at','desc')->get();
        return view('posts.following_posts',compact('posts'));
    }

    public function my_posts()
    {
        $posts=Auth::user()->posts()->OrderBy('created_at','desc')->get();
        return view('posts.my_posts',compact('posts'));
    }

    public function add_new_post()
    {
        return view('posts.add_new_post');
    }

    public function edit_post($id)
    {
        $post=Post::findOrFail($id);
        $this->authorize('update', $post);
        return view('posts.edit_post',compact('post'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'content'=>'nullable|string|max:200',
            'tags.*'=>'nullable|string|alpha_dash|max:50'
        ]);

        $content=$request->input('content');
        $content_items=explode(' ',$content);

        $tags=$request->input('tags');


        if($request->has('tags')) {
            $posts = new Post();
            foreach ($content_items as $item)
            {
                $posts=$posts->where('post_content','like','%'.$item.'%');
            }
            foreach ($tags as $tag) {
                $posts = $posts->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', '=', $tag);
                });
            }
            $posts = $posts->get();
        }
        else if($content != null){
            $posts=new Post();
            foreach ($content_items as $item)
            {
                $posts=$posts->where('post_content','like','%'.$item.'%');
            }
            $posts=$posts->get();
        }

        return view('search.posts_search',compact('posts','content','tags'));
    }
}
