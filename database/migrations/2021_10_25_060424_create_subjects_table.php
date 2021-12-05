<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('generation');
            $table->integer('semester');
            $table->integer('sks');
            $table->string('day');
            $table->time('start_at');
            $table->time('end_at');
            $table->timestamps();

            $table->integer('campus_id')->foreign('campus_id')->references('id')->on('campuses')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('lecture_id')->foreign('lecture_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
