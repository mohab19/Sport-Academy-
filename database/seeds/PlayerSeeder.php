<?php

use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 2;$i<7;$i++)
        {
            $player = new \App\models\Player();
            $player->school = "School".$i-1;
            $player->user_id = $i;
            $player->save();
        }
    }
}
