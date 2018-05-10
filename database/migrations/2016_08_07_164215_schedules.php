<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Schedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->unsigned();
            $table->integer('playground_id')->unsigned()->nullable();
            $table->integer('coach_id')->unsigned();
            $table->integer('day_id')->unsigned();
            $table->string('from');
            $table->string('to');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('schedules', function(Blueprint  $table)
        {
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('playground_id')->references('id')->on('playgrounds');
            $table->foreign('coach_id')->references('id')->on('coaches');
            $table->foreign('day_id')->references('id')->on('days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schedules');
    }
}
