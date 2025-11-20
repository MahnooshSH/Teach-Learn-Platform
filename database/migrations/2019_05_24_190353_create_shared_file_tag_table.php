<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharedFileTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_file_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shared_file_id');
            $table->unsignedInteger('tag_id');

            $table->foreign('shared_file_id')
                ->references('id')
                ->on('shared_files')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
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
        Schema::dropIfExists('shared_file_tag');
    }
}
