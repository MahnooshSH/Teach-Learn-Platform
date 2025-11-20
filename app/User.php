<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','first_name','last_name','profile_image','bio', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function post_likes()
    {
        return $this->hasMany(Post_like::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function question_votes()
    {
        return $this->hasMany(QuestionVote::class);
    }

    public function answer_votes()
    {
        return $this->hasMany(AnswerVote::class);
    }

    public function shared_files()
    {
        return $this->hasMany(SharedFile::class);
    }

    public function shared_file_votes()
    {
        return $this->hasMany(SharedFileVote::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class,'teacher_id');
    }

    public function student_courses()
    {
        return $this->belongsToMany(Course::class,'course_students','student_id','course_id');
    }

    public function quiz_answers()
    {
        return $this->hasMany(QuizAnswer::class,'student_id');
    }

    public function course_questions()
    {
        return $this->hasMany(CourseQuestion::class);
    }

    public function course_answers()
    {
        return $this->hasMany(CourseAnswer::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'follower_following','following_id','follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class,'follower_following','follower_id','following_id');
    }

    public function course_reviews()
    {
        return $this->hasMany(CourseReview::class);
    }


    public function user_setting()
    {
        return $this->hasOne(UserSetting::class);
    }




}
