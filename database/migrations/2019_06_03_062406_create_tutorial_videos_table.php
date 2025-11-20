<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorial_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('educational_session_id');
            $table->string('title');
            $table->string('tutorial_video');
            $table->string('video_type');
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
        Schema::dropIfExists('tutorial_videos');
    }
}
