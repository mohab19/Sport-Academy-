<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coaches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->increments('id');
            $table->double('salary');
            $table->integer('user_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('schedules_id');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('coaches', function(Blueprint  $table)
        {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_id')->references('id')->on('coaches_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coaches');

    }
}