<?php

namespace App\Providers;

use App\Course;
use App\Policies\CoursePolicy;
use App\Policies\PostPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\SharedFilePolicy;
use App\Post;
use App\Question;
use App\SharedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        Course::class => CoursePolicy::class,
        SharedFile::class => SharedFilePolicy::class,
        Question::class => QuestionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
