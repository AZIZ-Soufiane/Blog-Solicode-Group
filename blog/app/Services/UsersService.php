<?php

namespace App\Services;

use App\Models\User;

class UsersService extends BaseService
{
    public function totalUsers(): int
    {
        return User::count();
    }
}

