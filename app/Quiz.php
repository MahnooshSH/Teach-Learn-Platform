<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable=['educational_session_id','title','description','time_is_limited','limitation_time'];

    public function edu_session()
    {
        return $this->belongsTo(EducationalSession::class,'educational_session_id');
    }

    public function quiz_questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function quiz_answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }


}
