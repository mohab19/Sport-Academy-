<?php

use Illuminate\Database\Seeder;

class SchedulesTimesSeeder extends Seeder
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
        $day=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
        $from =['1:00','2:00','3:00','4:00','5:00'];
        $to =['2:00','3:00','4:00','5:00','6:00'];
        $counter = 1;
        for($i = 0;$i<5;$i++)
        {
            $schedule = new \App\models\ScheduleTimes();
            $schedule->day =$day[$i];
            $schedule->from =$from[$i];
            $schedule->to =$to[$i];
            $schedule->schedule_id =$counter;
            $schedule->save();
            $counter++;
            $place++;
            $coach++;
        }
    }
}
