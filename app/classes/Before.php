<?php

namespace App\classes;
use App\Models\User;
class Before
{

    public function before(User $user): bool|null
    {
        return $user->role_id=='1';
    }
}
