<?php

namespace App\Policies;

use App\Models\Colocation;
use App\Models\User;

class ColocationPolicy
{
    public function view(User $user, Colocation $colocation)
    {
        return $colocation->members->contains($user->id);
    }
}