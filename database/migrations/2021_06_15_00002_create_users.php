<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 15);
            $table->string('password');
            $table->string('fullname', 50);
            $table->string('remember_token', 255)->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('email', 100);

            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('class_id')->nullable();
            $table->foreign('class_id', 'class_fk_1001550')->references('id')->on('school_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
