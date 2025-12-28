<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function totalUsers()
    {
        return User::count();
    }
}
