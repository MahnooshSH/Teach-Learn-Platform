<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable=['title','course_image','overview','teacher_name'];

    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function edu_sessions()
    {
        return $this->hasMany(EducationalSession::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class,'course_students','course_id','student_id');
    }

    public function course_questions()
    {
        return $this->hasMany(CourseQuestion::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function course_rating()
    {
        return $this->hasOne(CourseRating::class);
    }

    public function course_reviews()
    {
        return $this->hasMany(CourseReview::class);
    }
}
