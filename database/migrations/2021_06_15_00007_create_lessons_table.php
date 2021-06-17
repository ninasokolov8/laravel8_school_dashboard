<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('weekday');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('teacher_id')->nullable();
            $table->unsignedInteger('class_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('lessons', function($table) {
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('class_id')->references('id')->on('school_classes');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
