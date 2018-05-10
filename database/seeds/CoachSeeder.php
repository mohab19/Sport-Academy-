<?php

use Illuminate\Database\Seeder;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $place = 1;
        $coach = 1;
        for($i = 7;$i<=11;$i++)
        {

            $user = new \App\models\Coach();
            $user->salary = "5000";
            $user->type_id = "1";
            $user->user_id = $i;
            $user->save();
            $coachplace = new  \App\models\CoachesPlaces();
            $coachplace->place_id = $place;
            $coachplace->coach_id = $coach;
            $coachplace->save();
            $coachplace = new  \App\models\CoachesLevels();
            $coachplace->level_id = $place;
            $coachplace->coach_id = $coach;
            $coachplace->save();
            $place++;
            $coach++;
        }
    }
}
