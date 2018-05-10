<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Incomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incomes_type_id')->unsigned();
            $table->integer('subscription_id')->unsigned()->nullable();
            $table->integer('receiver_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('player_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('quantity');
            $table->integer('price_per_unit');
            $table->integer('place_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('client_name');
            $table->double('value');
            $table->double('discount');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('incomes', function(Blueprint  $table)
        {
            $table->foreign('incomes_type_id')->references('id')->on('incomes_types');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('invoice_id')->references('id')->on('invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incomes');
    }
}
