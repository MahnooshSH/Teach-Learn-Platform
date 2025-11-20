<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }
    public function search(Request $request)
    {
        $tag=Tag::where('name','=',$request->input('search_tag'))->first();

        if($tag==null)
        {
            $no_find=1;
        }
        return view('search.tags_search',compact('tag','no_find'));
    }




    public function show_tag($tag_id)
    {
        $tag=Tag::findOrFail($tag_id);
        return view('tags.show_tag_page',compact('tag'));
    }
}
