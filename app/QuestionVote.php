<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionVote extends Model
{
    protected $fillable=['vote','user_id','question_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
