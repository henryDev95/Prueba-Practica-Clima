<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface LocationServiceInterface
{
    public function getAllLocations(): Collection;
}
