<?php

namespace App\Console\Commands;

use App\models\Subscription;
use Illuminate\Console\Command;

class Attendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $attendances = \App\models\Attendance::get();
        foreach ($attendances as $attendance)
        {
            $attendance->delete();
        }
        $data = array();
        $subscriptions = Subscription::get();
        foreach ($subscriptions as $subscription)
        {
            $player_user_id = $subscription->player->user_id;
            foreach ($subscription->schedules as $subscription_schedule)
            {
                if($subscription_schedule->schedule->day->name == date('l'))
                {
                    $coach_user_id = $subscription_schedule->schedule->coach->user_id;
                    $data['user_id'] = $coach_user_id;
                    $data['schedule_id'] = $subscription_schedule->schedule->id;
                    $data['team_schedule_id'] = null;
                    $data['type'] = "Indivduale";
                    \App\models\Attendance::create($data);
                    $data['user_id'] = $player_user_id;
                    \App\models\Attendance::create($data);
                }
        }
            foreach ($subscription->teams_schedules as $subscription_schedule)
            {
                if($subscription_schedule->team_schedule->day->name == date('l'))
                {
                    $coach_user_id = $subscription_schedule->team_schedule->coach->user_id;
                    $data['user_id'] = $coach_user_id;
                    $data['team_schedule_id'] = $subscription_schedule->team_schedule->id;
                    $data['schedule_id'] = null;
                    $data['type'] = "Team";
                    \App\models\Attendance::create($data);
                    $data['user_id'] = $player_user_id;
                    \App\models\Attendance::create($data);
                }
            }
        }
    }
}
