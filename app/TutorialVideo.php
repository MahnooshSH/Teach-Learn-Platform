<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorialVideo extends Model
{
    protected $fillable=['educational_session_id','title','tutorial_video','video_type'];

    public function edu_session()
    {
        return $this->belongsTo(EducationalSession::class,'educational_session_id');
    }
}
