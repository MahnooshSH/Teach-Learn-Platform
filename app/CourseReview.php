<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseReview extends Model
{
    protected $fillable=['comment','rate','course_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
