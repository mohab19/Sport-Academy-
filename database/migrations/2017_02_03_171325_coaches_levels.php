<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoachesLevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coach_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

        });
        Schema::table('coaches_levels', function(Blueprint  $table)
        {
            $table->foreign('coach_id')->references('id')->on('coaches');
            $table->foreign('level_id')->references('id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coaches_levels');
//
    }
}
