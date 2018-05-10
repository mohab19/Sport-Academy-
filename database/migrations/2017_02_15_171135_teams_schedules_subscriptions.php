<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeamsSchedulesSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams_schedules_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscription_id')->unsigned();
            $table->integer('team_schedule_id')->unsigned();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('teams_schedules_subscriptions', function(Blueprint  $table)
        {
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->foreign('team_schedule_id')->references('id')->on('teams_schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teams_schedules_subscriptions');
    }
}
