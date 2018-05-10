<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoachesPlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches_places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coach_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

        });
        Schema::table('coaches_places', function(Blueprint  $table)
        {
            $table->foreign('coach_id')->references('id')->on('coaches');
            $table->foreign('place_id')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coaches_places');

    }
}
