
<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->full_name = "aptware";
        $user->password  = bcrypt("aptware");
        $user->email = "products@apt-ware.com";
        $user->username = "aptware";
        $user->role_id = 1;
        $user->save();
    }
}
