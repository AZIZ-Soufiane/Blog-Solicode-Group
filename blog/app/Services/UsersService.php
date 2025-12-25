<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Collection; 
   
Class UsersService {
       public function totalUsers()
    {
        return User::count();
    }
}
   
