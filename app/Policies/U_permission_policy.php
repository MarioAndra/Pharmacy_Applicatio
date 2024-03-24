<?php

namespace App\Policies;
use App\classes\Before;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class U_permission_policy extends Before
{


    public function update(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('u_permission');
    }
}
