<?php

use Illuminate\Database\Seeder;

class PlaygroundsSeeder extends Seeder
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
            $level = new \App\models\Playground();
            $level->title = "Playground $i";
            $level->place_id = $i;
            $level->save();
        }
    }
}
