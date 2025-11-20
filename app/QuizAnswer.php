<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $fillable=['student_id','quiz_id','answer','true_count','wrong_count','unanswered_count','result'];

    public function student()
    {
        return $this->belongsTo(User::class,'student_id');
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
