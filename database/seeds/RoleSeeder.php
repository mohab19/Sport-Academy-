<?php

use App\Http\Utils\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    protected $permissions;
    public function __construct()
    {
        $this->permissions = new Permission();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\models\Roles::create([
            'name' => "Admin",
            'description'=> "Read and Write every thing in the system",
            'permissions' => json_encode([
                'adminpanel',
                'players',
                'player',
                'coaches',
                'coach',
                'attendances',
                'employees',
                'employee',
                'admins',
                'subscriptions',
                'schedules',
                'teams_schedules',
                'structure',
                'products',
                'product',
                'groups',
                'posts',
                'post',
                'settings',
                'reports',
                'sponsors',
                'news',
                'outcomes',
                'incomes',
                'invoices'
            ])
        ]);
        \App\models\Roles::create([
            'name' => "Coach",
            'description'=> "User that have permissions on his players",
            'permissions' => json_encode(['coachpanel','settings','coach'])
        ]);
        \App\models\Roles::create([
            'name' => "Employee",
            'description'=> "",
            'permissions' => json_encode([
                'employeepanel',
                'player',
                'coach',
                'players',
                'coaches',
                'structure',
                'schedules',
                'teams_schedules',
                'subscriptions',
                'attendances',
                'products',
                'outcomes',
                'incomes',
                'invoices',
                'groups',
                'posts',
                'settings'
            ])
        ]);
        \App\models\Roles::create([
            'name' => "Player",
            'description'=> "User that have all permissions in his profile",
            'permissions' => json_encode(['playerpanel','player','settings','posts'])
        ]);
        \App\models\Roles::create([
            'name' => "Super Employee",
            'description'=> "",
            'permissions' => json_encode([
                'employeepanel',
                'player',
                'coach',
                'players',
                'employees',
                'coaches',
                'structure',
                'schedules',
                'teams_schedules',
                'subscriptions',
                'attendances',
                'products',
                'outcomes',
                'incomes',
                'invoices',
                'reports',
                'groups',
                'posts',
                'settings'
            ])
        ]);
    }
}
