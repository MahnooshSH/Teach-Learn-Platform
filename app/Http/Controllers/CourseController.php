<?php

namespace App\Http\Controllers;

use App\Course;
use App\EducationalSession;
use App\Lesson;
use App\Quiz;
use App\Tag;
use App\TutorialVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }


    public function create(Request $request)
    {

        $request->validate([
            'title'=>'required|string|max:90',
            'course_image'=>'required|file|mimes:jpg,jpeg,png|max:2048',
            'overview'=>'required|string|max:4000',
            'tags.*'=>'nullable|string|alpha_dash|max:50'

        ]);

        $user=Auth::user();
        $title=$request->input('title');
        $overview=$request->input('overview');

        $tags=$request->input('tags');


        if ($request->hasFile('course_image'))
        {


            $path = $request->file('course_image')->store('course_images', 'public');

            Image::make(storage_path('app/public/'.$path))
                ->resize(540,304)
                ->save(storage_path('app/public/'.$path));

            $course = $user->courses()
                ->create(['title' => $title, 'course_image' => $path, 'overview' => $overview]);


            $course->course_rating()->create(['review_count'=>0,'rate'=>0]);


            if ($request->has('tags')) {
                foreach ($tags as $tag) {
                    $tag_saved = Tag::firstOrCreate(['name' => $tag]);
                    $tag_id = $tag_saved->id;
                    $course->tags()->attach($tag_id);
                }
            }
        }


        return redirect(route('teaching.my_courses_as_teacher'));

    }


    public function update(Request $request,$id)
    {
        $course=Course::find($id);

        $this->authorize('update',$course );

        $request->validate([
            'title'=>'required|string|max:90',
            'course_image'=>'file|mimes:jpg,jpeg,png|max:2048',
            'overview'=>'required|string|max:4000',
            'tags.*'=>'nullable|string|alpha_dash|max:50'

        ]);

        $title=$request->input('title');
        $overview=$request->input('overview');

        if ($request->hasFile('course_image'))
        {
            $old_path=$course->course_image;

            $path = $request->file('course_image')->store('course_images', 'public');

            Image::make(storage_path('app/public/'.$path))
                ->resize(540,304)
                ->save(storage_path('app/public/'.$path));

            $course->update(['title' => $title, 'course_image' => $path, 'overview' => $overview]);

            if(is_file((storage_path('app/public/'.$old_path))))
            {
                Storage::disk('public')->delete($old_path);
            }


        }
        else
        {
            $course->update(['title' => $title,'overview' => $overview]);

        }


        if($request->has('tags'))
        {
            $tags=$request->input('tags');
            $tag_id=array();
            foreach ($tags as $tag)
            {
                $tag_saved=Tag::firstOrCreate(['name' => $tag]);
                array_push($tag_id,$tag_saved->id);



            }
            $course->tags()->sync($tag_id);
        }
        else
        {
            $course->tags()->detach();
        }

        return redirect(route('course.about_the_course',['id'=>$id]));
    }



    public function course_register($course_id)
    {
        Auth::user()->student_courses()->attach($course_id);
    }
    public function leave_course($course_id)
    {
        Auth::user()->student_courses()->detach($course_id);
    }


    public function my_courses_as_teacher()
    {
        $courses=Auth::user()->courses()->OrderBy('created_at','desc')->get();
        return view('teaching.my_courses_as_teacher',compact('courses'));
    }

    public function create_new_course()
    {
        return view('teaching.create_new_course');
    }

    public function my_courses_as_student()
    {
        $courses=Auth::user()->student_courses()->OrderBy('created_at','desc')->get();
        return view('learning.my_courses_as_student',compact('courses'));
    }

    public function top_courses()
    {
        $courses=Course::join('course_ratings', 'courses.id', '=', 'course_ratings.course_id')
            ->orderBy('course_ratings.rate','desc')
            ->orderBy('course_ratings.review_count','desc')
            ->select('courses.*')
            ->orderBy('created_at','desc')
            ->get();
        return view('learning.top_courses',compact('courses'));
    }

    public function about_the_course($id)
    {
        $course=Course::findOrFail($id);
        return view('course.about_the_course',compact('course'));
    }
    public function course_content($id)
    {
        $course=Course::findOrFail($id);
        return view('course.course_content',compact('course'));
    }

    public function resources($id)
    {
        $course=Course::findOrFail($id);
        return view('course.resources',compact('course'));
    }

    public function qa($id)
    {
        $course=Course::findOrFail($id);
        return view('course.qa',compact('course'));
    }

    public function course_management($id)
    {
        $course=Course::findOrFail($id);

        $this->authorize('teacher_access',$course );

        return view('course.course_management.edit_course_info',compact('course'));
    }

    public function show_tutorial_video($course_id,$edu_session_id,$tutorial_video_id)
    {
        $course=Course::findOrFail($course_id);
        $tutorial_video=TutorialVideo::findOrFail($tutorial_video_id);
        $this_edu_session=EducationalSession::findorfail($edu_session_id);
        return view('course.show_tutorial_video',compact('course','tutorial_video','this_edu_session'));
    }

    public function show_quiz($course_id,$edu_session_id,$quiz_id)
    {
        $course=Course::findOrFail($course_id);
        $quiz=Quiz::findOrFail($quiz_id);
        $this_edu_session=EducationalSession::findorfail($edu_session_id);
        return view('course.show_quiz',compact('course','quiz','this_edu_session'));
    }

    public function show_lesson($course_id,$lesson_id)
    {
        $course=Course::findOrFail($course_id);
        $lesson=Lesson::findOrFail($lesson_id);
        return view('course.show_lesson',compact('course','lesson'));
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
            $courses = new Course();
            foreach ($content_items as $item)
            {
                $courses=$courses->where('title','like','%'.$item.'%');
            }
            foreach ($tags as $tag) {
                $courses = $courses->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', '=', $tag);
                });
            }
            $courses = $courses->get();
        }
        else if($content != null){
            $courses=new Course();
            foreach ($content_items as $item)
            {
                $courses=$courses->where('title','like','%'.$item.'%');
            }
            $courses=$courses->get();
        }

        return view('search.courses_search',compact('courses','content','tags'));
    }

}
