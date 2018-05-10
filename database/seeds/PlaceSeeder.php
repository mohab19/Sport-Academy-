<?php

use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i<=5;$i++)
        {
            $level = new \App\models\Place();
            $level->name = "Place $i";
            $level->price =5000;
            $level->save();
        }
    }
}
