<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesAvailableNoticesAlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branchesAvailable_noticesAlter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notice_id')->unsigned();
            $table->foreign('notice_id')->references('id')->on('noticesAlter')->onDelete('cascade');

            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branchesAvailable')->onDelete('cascade');

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
        Schema::drop('branchesAvailable_noticesAlter');
    }
}
