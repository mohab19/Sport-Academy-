<?php

namespace App\Console\Commands;

use App\Http\Controllers\UsersController;
use App\models\Coach;
use App\models\Employee;
use App\models\OutCome;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Salaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salaries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Salaries';

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
        $employees  = Employee::get();
        $coaches  = Coach::get();
        foreach ($employees as $employee)
        {
            $outcome = new OutCome();
            $outcome->outcomes_type_id = 3;
            $outcome->user_id = $employee->user_id;
            $outcome->value = $employee->salary;
            $outcome->save();
        }
        foreach ($coaches as $coach)
        {
            $outcome = new OutCome();
            $outcome->outcomes_type_id = 3;
            $outcome->user_id = $coach->user_id;
            $outcome->value = $coach->salary;
            $outcome->save();
        }
    }
}
