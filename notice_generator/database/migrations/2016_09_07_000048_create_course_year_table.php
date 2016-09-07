<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_year', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('year_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('course_year', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('coursesAvailable');
            $table->foreign('year_id')->references('id')->on('yearsAvailable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_year');
    }
}
