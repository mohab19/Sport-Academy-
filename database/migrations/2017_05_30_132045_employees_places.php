<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeesPlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->integer('place_id')->unsigned();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

        });
        Schema::table('employees_places', function(Blueprint  $table)
        {
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::drop('employees_places');

    }
}
