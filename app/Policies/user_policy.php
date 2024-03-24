<?php

namespace App\Policies;
use App\classes\Before;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class user_policy extends Before
{

    use HandlesAuthorization;


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
