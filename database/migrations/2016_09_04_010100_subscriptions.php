<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('level_id')->unsigned()->nullable();
            $table->integer('place_id')->unsigned()->nullable();
            $table->double('total');
            $table->double('discount');
            $table->double('paid');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('subscriptions', function(Blueprint  $table)
        {
            $table->foreign('player_id')->nullable()->references('id')->on('players');
            $table->foreign('user_id')->nullable()->references('id')->on('users');
            $table->foreign('level_id')->nullable()->references('id')->on('levels');
            $table->foreign('place_id')->nullable()->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subscriptions');
    }
}