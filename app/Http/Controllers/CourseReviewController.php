<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
    }
    public function create(Request $request ,$course_id)
    {
        $course = Course::findOrFail($course_id);

        $this->authorize('student_access', $course);

        $request->validate([
            'comment'=>'nullable|string|max:1000',
            'rate'=>'required|numeric|min:1|max:5',
        ]);

        $comment=$request->input('comment');
        $rate=$request->input('rate');
        $user=Auth::user();

        if($user->course_reviews()->where('course_id',$course_id)->exists())
        {
            $user->course_reviews()->where('course_id',$course_id)->delete();
        }

        $user->course_reviews()->create(['course_id'=>$course_id,'rate'=>$rate,'comment'=>$comment]);

        $course_rate_sum=$course->course_reviews->sum('rate');
        $course_review_count=$course->course_reviews->count();
        if($course_review_count==0)
        {
            $course_rate=0;
        }
        else
        {
            $course_rate=$course_rate_sum/$course_review_count;
        }

        $course->course_rating()->update(['review_count'=>$course_review_count,'rate'=>$course_rate]);

        return redirect(route('course.about_the_course',['course_id'=>$course_id]));

    }
}
