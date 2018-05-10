<?php

use Illuminate\Database\Seeder;

class ExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $price =150;
        for($i = 1;$i<=5;$i++)
        {
            $level = new \App\models\Extra();
            $level->name = "Extra $i";
            $level->price = $price;
            $level->save();
            $price *=2;
        }
    }
}
