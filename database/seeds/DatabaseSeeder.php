<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
//         $this->call(InComesTypesSeeder::class);
//         $this->call(OutComesTypesSeeder::class);
//         $this->call(LevelSeeder::class);
//         $this->call(PlaceSeeder::class);
//         $this->call(PlaygroundsSeeder::class);
//         $this->call(ExtraSeeder::class);
//         $this->call(ProductSeeder::class);
//        $this->call(PlayerSeeder::class);
//        $this->call(CoachTypeaSeeder::class);
//        $this->call(CoachSeeder::class);
//        $this->call(EmployeeSeeder::class);
//        $this->call(DaysSeeder::class);
//        $this->call(ReportsSeeder::class);
//        $this->call(AdminsReportsSeeder::class);
//        $this->call(SchedulesSeeder::class);

//            $this->call(PostsTypesSeeder::class);
            $this->call(NotificationsTypesSeeder::class);
    }
}
