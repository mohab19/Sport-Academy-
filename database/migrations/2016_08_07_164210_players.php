<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Players extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('level_id')->unsigned()->nullable();
            $table->integer('place_id')->unsigned()->nullable();
            $table->string('school');
            $table->integer('current_rank');
            $table->integer('best_rank');
            $table->string('old_places');
            $table->string('duration');
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('blocked')->default(0);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('players', function(Blueprint  $table)
        {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('level_id')->references('id')->on('levels');
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
        Schema::drop('players');

    }
}