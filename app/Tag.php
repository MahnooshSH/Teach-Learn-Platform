<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable=['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function shared_files()
    {
        return $this->belongsToMany(SharedFile::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
