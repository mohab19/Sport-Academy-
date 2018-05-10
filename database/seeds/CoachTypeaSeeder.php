<?php

use Illuminate\Database\Seeder;

class CoachTypeaSeeder extends Seeder
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
            $type = new \App\models\CoachesTypes();
            $type->name = "Type $i";
            $type->save();
        }
    }
}
