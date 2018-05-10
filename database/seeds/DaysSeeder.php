<?php

use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
        foreach ($days as $item)
        {
            $day = new \App\models\Day();
            $day->name = $item;
            $day->save();
        }
    }
}
