<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable=['question','answer1','answer2','answer3','answer4','true_answer','quiz_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
