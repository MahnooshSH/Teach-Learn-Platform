<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('educational_session_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('time_is_limited')->default(0);
            $table->integer('limitation_time')->nullable();
            $table->timestamps();


            $table->foreign('educational_session_id')
                ->references('id')->on('educational_sessions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
