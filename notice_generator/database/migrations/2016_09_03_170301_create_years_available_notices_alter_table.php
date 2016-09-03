<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsAvailableNoticesAlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearsAvailable_noticesAlter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notice_id')->unsigned();
            $table->foreign('notice_id')->references('id')->on('noticesAlter')->onDelete('cascade');

            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('yearsAvailable')->onDelete('cascade');

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
        Schema::drop('yearsAvailable_noticesAlter');
    }
}
