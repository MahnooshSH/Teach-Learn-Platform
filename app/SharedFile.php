<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    protected $fillable=['title','file','file_type','caption'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function shared_file_votes()
    {
        return $this->hasMany(SharedFileVote::class);
    }
}
