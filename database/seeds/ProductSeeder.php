<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1;$i<5;$i++)
        {
            $player = new \App\models\Product();
            $player->name = "Product $i";
            $player->user_id = $i;
            $player->place_id = 1;
            $player->quantity = 10;
            $player->price = 250;
            $player->save();
        }
    }
}
