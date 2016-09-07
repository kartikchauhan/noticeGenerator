<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_section', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('branch_section', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branchesAvailable');
            $table->foreign('section_id')->references('id')->on('sectionsAvailable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('branch_section');
    }
}
