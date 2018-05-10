<?php

use Illuminate\Database\Seeder;

class OutComesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\models\OutComesType::create(['name' => 'Rent']);
        \App\models\OutComesType::create(['name' => 'Product']);
        \App\models\OutComesType::create(['name' => 'Salary']);
        \App\models\OutComesType::create(['name' => 'Penalty']);
        \App\models\OutComesType::create(['name' => 'Extra']);
        \App\models\OutComesType::create(['name' => 'Extra OutCome']);
    }
}
