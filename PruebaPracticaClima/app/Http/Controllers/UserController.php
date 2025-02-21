<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use Illuminate\Support\Collection;

class UserController extends Controller
{

    public function __construct()
    {

    }

    public function index(UserServiceInterface $userService): Collection
    {
        return $userService->allUsers();
    }
}
