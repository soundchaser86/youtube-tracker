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
        Schema::create('video_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_id')->constrained();
            $table->unsignedBigInteger('views');
            $table->unsignedBigInteger('views_first_hour');
            $table->unsignedBigInteger('likes');
            $table->unsignedBigInteger('dislikes');
            $table->unsignedBigInteger('comment_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_statistics');
    }
};
