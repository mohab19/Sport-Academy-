<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Outcomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outcomes_type_id')->unsigned();
            $table->integer('subscription_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('receiver_id')->unsigned()->nullable();
            $table->integer('player_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('quantity');
            $table->integer('coach_id')->unsigned()->nullable();
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('place_id')->unsigned()->nullable();
            $table->string('client_name');
            $table->string('title');
            $table->double('value');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('outcomes', function(Blueprint  $table)
        {
            $table->foreign('outcomes_type_id')->references('id')->on('outcomes_types');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('coach_id')->references('id')->on('coaches');
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::drop('outcomes');

    }
}
