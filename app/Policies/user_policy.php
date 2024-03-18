<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class user_policy
{

    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null
{
    if ($user->role_id=='1') {
        return true;
    }

    return null;
}

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_user');

    }


    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo('view_user');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_user');
    }


    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo('update_user');
    }


    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo('delete_user');
    }



}
