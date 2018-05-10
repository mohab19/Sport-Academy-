<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Attachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('post_id')->unsigned()->nullable();
            $table->string('value');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('attachments', function(Blueprint  $table)
        {
            $table->foreign('user_id')->nullable()->references('id')->on('users');
            $table->foreign('post_id')->nullable()->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachments');
    }
}