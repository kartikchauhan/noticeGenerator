<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notice_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branchesAvailable');
            $table->foreign('notice_id')->references('id')->on('notices');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('branches');
    }
}
