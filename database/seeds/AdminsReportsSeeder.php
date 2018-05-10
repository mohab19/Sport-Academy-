<?php

use Illuminate\Database\Seeder;

class AdminsReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = \App\models\Report::get();
        foreach ($reports as $report)
        {
            $admin_report = new \App\models\AdminReports();
            $admin_report->report_id = $report->id;
            $admin_report->user_id = 1;
            $admin_report->save();
        }
    }
}
