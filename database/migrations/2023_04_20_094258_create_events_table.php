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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable()->default(null);
            $table->integer("event_category_id")->nullable()->default(null);
            $table->unsignedBigInteger("user_id")->nullable()->default(null);
            $table->dateTime("start_time")->nullable()->default(null);
            $table->dateTime("end_time")->nullable()->default(null);
            $table->string("location")->nullable()->default(null);
            $table->tinyInteger("status")->default(0);
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
        Schema::dropIfExists('events');
    }
};
