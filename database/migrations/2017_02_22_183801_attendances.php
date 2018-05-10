<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Attendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id')->unsigned()->nullable();
            $table->integer('team_schedule_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('type');
            $table->tinyInteger('attend')->default(0);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('attendances', function(Blueprint  $table)
        {
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('team_schedule_id')->references('id')->on('teams_schedules');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendances');
//
    }
}
