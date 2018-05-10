<?php

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $price = 500;
        for($i = 1;$i<=5;$i++)
        {
            $level = new \App\models\Level();
            $level->name = "Level $i";
            $level->price = 500;
            $level->max = 1;
            $level->save();
            $price*=1.2;
        }
    }
}
