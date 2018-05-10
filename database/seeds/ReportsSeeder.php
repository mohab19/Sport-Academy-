<?php

use Illuminate\Database\Seeder;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\models\Report::create(['value' => 'subscriptions','title' => 'Subscriptions']);
        \App\models\Report::create(['value' => 'debts','title' => 'Subscriptions Debts']);
        \App\models\Report::create(['value' => 'sold','title' => 'Sold Products']);
        \App\models\Report::create(['value' => 'purchased','title' => 'Purchased  Products']);
        \App\models\Report::create(['value' => 'products_debts','title' => 'Products Debt']);
        \App\models\Report::create(['value' => 'rents','title' => 'Places Rent']);
        \App\models\Report::create(['value' => 'salaries','title' => 'Salaries']);
        \App\models\Report::create(['value' => 'outcomes','title' => 'Outcomes']);
        \App\models\Report::create(['value' => 'incomes','title' => 'Incomes']);
    }
}
