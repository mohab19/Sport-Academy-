<?php

namespace App\Console;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PartnersController;
use App\models\Employee;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\Salaries::class,
        Commands\Rents::class,
        Commands\Subscriptions::class,
        Commands\Attendance::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('salaries')->monthlyOn(1,'00:30')->timezone('Africa/Cairo');
        $schedule->command('rents')->monthlyOn(1,'00:30')->timezone('Africa/Cairo');
        $schedule->command('subscriptions')->monthlyOn(1,'00:30')->timezone('Africa/Cairo');
        $schedule->command('attendances')->dailyAt('00:30')->timezone('Africa/Cairo');
        $schedule->command('attendances')->cron('* * * * * *')->timezone('Africa/Cairo');
    }
}
