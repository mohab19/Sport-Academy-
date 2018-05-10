<?php

namespace App\Policies;

use App\models\Roles;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
    }

    public function admin(User $user)
    {
        return $user->role->name == "Admin";
    }

    public function player(User $user)
    {
        return $user->role->name == "Player";
    }
    public function coach(User $user)
    {
        return $user->role->name == "Coach";
    }
    public function employee(User $user)
    {
        return $user->role->name == "Employee";
    }


}
