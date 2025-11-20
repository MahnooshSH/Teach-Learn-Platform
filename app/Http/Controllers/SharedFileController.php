<?php

namespace App\Http\Controllers;

use App\SharedFile;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SharedFileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate')->except('download');
    }

    public function create(Request $request)
    {

        $request->validate([
            'title'=>'required|string|max:300',
            'file'=>'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'caption'=>'nullable|string|max:2500',
            'tags.*'=>'nullable|string|alpha_dash|max:50'

        ]);

        $user=Auth::user();
        $title=$request->input('title');
        $caption=$request->input('caption');

        $tags=$request->input('tags');


        if ($request->hasFile('file'))
        {


            $path = $request->file('file')->store('shared_files', 'public');
            $file_type = $request->file('file')->getClientOriginalExtension();

            $shared_file = $user->shared_files()
                ->create(['title' => $title, 'file' => $path, 'file_type' => $file_type, 'caption' => $caption]);


            if ($request->has('tags')) {
                foreach ($tags as $tag) {
                    $tag_saved = Tag::firstOrCreate(['name' => $tag]);
                    $tag_id = $tag_saved->id;
                    $shared_file->tags()->attach($tag_id);
                }
            }
        }


        return redirect(route('library.my_shared_files'));

    }


    public function update(Request $request,$id)
    {
        $shared_file=SharedFile::findOrFail($id);
        $this->authorize('update', $shared_file);

        $request->validate([
            'title'=>'required|string|max:300',
            'caption'=>'nullable|string|max:2500',
            'tags.*'=>'nullable|string|alpha_dash|max:50'

        ]);

        $shared_file->update($request->only('title','caption'));

        if ($request->has('tags')) {
            $tags=$request->input('tags');
            $tag_id=array();
            foreach ($tags as $tag) {
                $tag_saved = Tag::firstOrCreate(['name' => $tag]);
                array_push($tag_id,$tag_saved->id);
            }
            $shared_file->tags()->sync($tag_id);
        }
        else
        {
            $shared_file->tags()->detach();
        }


        return redirect(route('library.my_shared_files'));

    }


    public function delete($id)
    {
        $shared_file=SharedFile::findOrFail($id);
        $this->authorize('delete', $shared_file);

        $old_path=$shared_file->file;

        if(is_file((storage_path('app/public/'.$old_path))))
        {
            Storage::disk('public')->delete($old_path);
        }

        $shared_file->delete();
        return redirect(route('library.my_shared_files'));
    }


    public function download($id)
    {
        $shared_file=SharedFile::findOrFail($id);
        $pathToFile="storage/".$shared_file->file;
        $name=$shared_file->title.'.'.$shared_file->file_type;
        return response()->download($pathToFile, $name);
    }

    public function following_shared_files()
    {
        $following=Auth::user()->following;
        $following_id=array();
        foreach ($following as $item)
        {
            array_push($following_id,$item->id);
        }

        $shared_files=SharedFile::whereIn('user_id',$following_id)->OrderBy('created_at','desc')->get();
        return view('library.following_shared_files',compact('shared_files'));
    }

    public function top_shared_files()
    {
        $shared_files=SharedFile::withCount(['shared_file_votes'=> function ($query) {
            $query->where('vote', 1);
        }])->orderByDesc('shared_file_votes_count')->orderBy('created_at','desc')->get();
        return view('library.top_shared_files',compact('shared_files'));
    }


    public function my_shared_files()
    {
        $shared_files=Auth::user()->shared_files()->OrderBy('created_at','desc')->get();
        return view('library.my_shared_files',compact('shared_files'));
    }

    public function share_file()
    {
        return view('library.share_file');
    }

    public function edit_shared_file($id)
    {
        $shared_file=SharedFile::findOrFail($id);
        $this->authorize('update', $shared_file);
        return view('library.edit_shared_file',compact('shared_file'));

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
            $shared_files = new SharedFile();
            foreach ($content_items as $item)
            {
                $shared_files=$shared_files->where('title','like','%'.$item.'%');
            }
            foreach ($tags as $tag) {
                $shared_files = $shared_files->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', '=', $tag);
                });
            }
            $shared_files = $shared_files->get();
        }
        else if($content != null){
            $shared_files=new SharedFile();
            foreach ($content_items as $item)
            {
                $shared_files=$shared_files->where('title','like','%'.$item.'%');
            }
            $shared_files=$shared_files->get();
        }

        return view('search.library_search',compact('shared_files','content','tags'));
    }
}
