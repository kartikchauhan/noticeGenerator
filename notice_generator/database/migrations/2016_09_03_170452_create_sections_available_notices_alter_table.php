<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsAvailableNoticesAlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectionsAvailable_noticesAlter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notice_id')->unsigned();
            $table->foreign('notice_id')->references('id')->on('noticesAlter')->onDelete('cascade');

            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sectionsAvailable')->onDelete('cascade');

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
        Schema::drop('sectionsAvailable_noticesAlter');
    }
}
