<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable=['title','file','file_type','course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
