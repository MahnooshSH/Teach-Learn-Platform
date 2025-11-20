<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseRating extends Model
{
    protected $fillable=['course_id','review_count','rate'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
