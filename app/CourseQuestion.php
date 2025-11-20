<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseQuestion extends Model
{
    protected $fillable=['question','user_id','course_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function course_answers()
    {
        return $this->hasMany(CourseAnswer::class);
    }
}
