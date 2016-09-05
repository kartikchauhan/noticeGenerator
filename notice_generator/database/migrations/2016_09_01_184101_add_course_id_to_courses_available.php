<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseIdToCoursesAvailable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coursesAvailable', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
        });

        Schema::table('coursesAvailable', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('coursesAvailable');
        });
           
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coursesAvailable', function (Blueprint $table) {
            //
        });
    }
}
