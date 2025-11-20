<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('quiz_id');
            $table->text('answer');
            $table->integer('true_count')->default(0);
            $table->integer('wrong_count')->default(0);
            $table->integer('unanswered_count')->default(0);
            $table->integer('result')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('quiz_id')
                ->references('id')->on('quizzes')
                ->onDelete('cascade');

            $table->unique(['quiz_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_answers');
    }
}
