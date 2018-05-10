<?php

use Illuminate\Database\Seeder;

class InComesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\models\InComesType::create(['name' => 'Add Subscription']);
        \App\models\InComesType::create(['name' => 'Sell Product']);
        \App\models\InComesType::create(['name' => 'Extra InCome']);
        \App\models\InComesType::create(['name' => 'Renew Subscription']);
    }
}
