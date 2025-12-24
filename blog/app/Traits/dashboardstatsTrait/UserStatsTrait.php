<?php

namespace App\Traits\dashboardstatsTrait; 


use App\Models\User;

trait UserStatsTrait
{
    public function totalUsers()
    {
        return User::count();
    }
}
