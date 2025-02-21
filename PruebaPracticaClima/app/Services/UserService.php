<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    public function allUsers(): Collection
    {
        return User::with('location.weather')->get();
    }

}
