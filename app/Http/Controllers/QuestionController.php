<?php

namespace App\Http\Controllers;

use App\Question;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }


    public function create_question(Request $request)
    {


        $request->validate([
            'question'=>'required|string|max:500',
            'description'=>'nullable|string|max:3000',
            'tags.*'=>'nullable|string|alpha_dash|max:50'
        ]);


        $question=Auth::user()->questions()->create($request->only('question','description'));

        $tags=$request->input('tags');

        if($request->has('tags'))
        {
            foreach ($tags as $tag)
            {
                $tag_saved=Tag::firstOrCreate(['name' => $tag]);
                $tag_id=$tag_saved->id;
                $question->tags()->attach($tag_id);
            }
        }


        return redirect(route('question_answer.my_questions'));

    }


    public function update_question(Request $request,$id)
    {

        $request->validate([
            'question'=>'required|string|max:500',
            'description'=>'nullable|string|max:3000',
            'tags.*'=>'nullable|string|alpha_dash|max:50'
        ]);

        $question=Question::findOrFail($id);
        $this->authorize('update', $question);

        $question->update($request->only('question','description'));



        if ($request->has('tags')) {
            $tags=$request->input('tags');
            $tag_id=array();
            foreach ($tags as $tag) {
                $tag_saved = Tag::firstOrCreate(['name' => $tag]);
                array_push($tag_id,$tag_saved->id);
            }
            $question->tags()->sync($tag_id);
        }
        else
        {
            $question->tags()->detach();
        }


        return redirect(route('question_answer.my_questions'));
    }

    public function delete_question($id)
    {
        $question=Question::findOrFail($id);
        $this->authorize('delete', $question);

        $question->delete();
        return redirect(route('question_answer.my_questions'));
    }


    public function recent_questions()
    {
        $questions=Question::orderBy('created_at', 'desc')->get();
        return view('question_answer.recent_questions',compact('questions'));
    }

    public function top_questions()
    {
        $questions=Question::withCount(['question_votes'=> function ($query) {
            $query->where('vote', 1);
        }])->orderByDesc('question_votes_count')->orderBy('created_at','desc')->get();
        return view('question_answer.top_questions',compact('questions'));
    }

    public function following_questions()
    {
        $following=Auth::user()->following;
        $following_id=array();
        foreach ($following as $item)
        {
            array_push($following_id,$item->id);
        }

        $questions=Question::whereIn('user_id',$following_id)->OrderBy('created_at','desc')->get();
        return view('question_answer.following_questions',compact('questions'));
    }


    public function my_questions()
    {
        $questions=Auth::user()->questions()->orderBy('created_at', 'desc')->get();
        return view('question_answer.my_questions',compact('questions'));
    }

    public function ask_question()
    {
        return view('question_answer.ask_question');
    }

    public function edit_question($id)
    {
        $question=Question::findOrFail($id);
        $this->authorize('update', $question);
        return view('question_answer.edit_question',compact('question'));
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
            $questions = new Question();
            foreach ($content_items as $item)
            {
                $questions=$questions->where('question','like','%'.$item.'%');
            }
            foreach ($tags as $tag) {
                $questions = $questions->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', '=', $tag);
                });
            }
            $questions = $questions->get();
        }
        else if($content != null){
            $questions=new Question();
            foreach ($content_items as $item)
            {
                $questions=$questions->where('question','like','%'.$item.'%');
            }
            $questions=$questions->get();
        }

        return view('search.qa_search',compact('questions','content','tags'));
    }
}
