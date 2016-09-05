<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseIdToBranchesAvailable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branchesAvailable', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
        });

        Schema::table('branchesAvailable', function (Blueprint $table) {
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
        Schema::table('branchesAvailable', function (Blueprint $table) {
            //
        });
    }
}
