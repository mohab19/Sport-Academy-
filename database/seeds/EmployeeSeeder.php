<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
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
        for($i = 12;$i<=16;$i++)
        {

            $user = new \App\models\Employee();
            $user->salary = "5000";
            $user->user_id = $i;
            $user->save();
            $coachplace = new  \App\models\EmployeesPlaces();
            $coachplace->place_id = $place;
            $coachplace->employee_id = $coach;
            $coachplace->save();
            $place++;
            $coach++;
        }
    }
}
