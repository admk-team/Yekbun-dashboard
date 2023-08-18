<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('playlist_name');
            $table->integer('visibility');
            $table->integer('music_id')->nullable();
            $table->integer('feed_id')->nullable();
            $table->integer('news_id')->nullable();
            $table->integer('history_id')->nullable();
            $table->integer('vote_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlists');
    }
};
