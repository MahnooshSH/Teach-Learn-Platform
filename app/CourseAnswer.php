<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseAnswer extends Model
{
    protected $fillable=['answer','user_id','course_question_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course_question()
    {
        return $this->belongsTo(CourseQuestion::class);
    }
}
