<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable=['lesson_number','title','description','course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function edu_sessions()
    {
        return $this->hasMany(EducationalSession::class);
    }
}
