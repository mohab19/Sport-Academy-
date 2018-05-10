<?php

use Illuminate\Database\Seeder;

class NotificationsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\models\NotificationType::create(['name' => 'new_private']);
        \App\models\NotificationType::create(['name' => 'new_public']);
        \App\models\NotificationType::create(['name' => 'comment']);
        \App\models\NotificationType::create(['name' => 'also comment']);
    }
}
