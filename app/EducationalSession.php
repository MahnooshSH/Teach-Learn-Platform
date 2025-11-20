<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalSession extends Model
{

    protected $fillable=['course_id','lesson_id','session_type'];


    public function tutorial_video()
    {
        return $this->hasOne(TutorialVideo::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
