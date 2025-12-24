<?php

namespace App\Traits\DashboardstatsTrait; 


use App\Models\User;

trait UserStatsTrait
{
    public function totalUsers()
    {
        return User::count();
    }
}
