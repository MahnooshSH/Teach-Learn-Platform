<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerVote extends Model
{
    protected $fillable=['vote','answer_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
