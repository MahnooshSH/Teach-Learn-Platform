<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowerFollowingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follower_following', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('follower_id');
            $table->unsignedInteger('following_id');
            $table->timestamps();

            $table->foreign('follower_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('following_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->unique(['follower_id', 'following_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follower_following');
    }
}
