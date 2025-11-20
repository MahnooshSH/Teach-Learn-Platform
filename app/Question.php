<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=['question','description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function question_votes()
    {
        return $this->hasMany(QuestionVote::class);
    }
}
