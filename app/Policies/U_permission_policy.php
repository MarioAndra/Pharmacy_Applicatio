<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class U_permission_policy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role_id=='1') {
            return true;
        }

        return null;
    }

    public function update(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('u_permission');
    }
}
