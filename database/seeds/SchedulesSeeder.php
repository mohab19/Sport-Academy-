<?php

use Illuminate\Database\Seeder;

class   SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $from=date_create("09:00");
//        for($i = 0;$i<99;$i++)
//        {
//            if(strtotime(date_format($from,"H:i"))>=strtotime("20:15"))
//                break;
//            $schedule = new \App\models\Schedule();
//            $schedule->day_id =2;
//            $schedule->from =date_format($from,"H:i");
//            $to =  date_add($from,date_interval_create_from_date_string("45 minutes"));
//            $schedule->to =date_format($to,"H:i");
//            $schedule->place_id =2;
//            $schedule->coach_id =19;
//            $schedule->playground_id =2;
//            $schedule->save();
//        }
        $from1=date_create("16:30");
        for($i = 0;$i<99;$i++)
        {
            if(strtotime(date_format($from1,"H:i"))>=strtotime("18:00"))
                break;
            $schedule = new \App\models\Schedule();
            $schedule->day_id =3;
            $schedule->from =date_format($from1,"H:i");
            $to1 =  date_add($from1,date_interval_create_from_date_string("45 minutes"));
            $schedule->to =date_format($to1,"H:i");
            $schedule->place_id =2;
            $schedule->coach_id =19;
            $schedule->playground_id =2;
            $schedule->save();
        }
        $from1=date_create("16:30");
        for($i = 0;$i<99;$i++)
        {
            if(strtotime(date_format($from1,"H:i"))>=strtotime("18:00"))
                break;
            $schedule = new \App\models\Schedule();
            $schedule->day_id =5;
            $schedule->from =date_format($from1,"H:i");
            $to1 =  date_add($from1,date_interval_create_from_date_string("45 minutes"));
            $schedule->to =date_format($to1,"H:i");
            $schedule->place_id =2;
            $schedule->coach_id =19;
            $schedule->playground_id =2;
            $schedule->save();
        }
    }
}
