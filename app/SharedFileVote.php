<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SharedFileVote extends Model
{
    protected $fillable=['vote','shared_file_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shared_file()
    {
        return $this->belongsTo(SharedFile::class);
    }
}
