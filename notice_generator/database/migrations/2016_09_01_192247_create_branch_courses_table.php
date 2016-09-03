<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('branch_course', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branchesAvailable');
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
        Schema::drop('branch_course');
    }
}
