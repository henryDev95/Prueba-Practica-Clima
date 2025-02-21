<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function allUsers(): Collection;
}
