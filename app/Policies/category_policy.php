<?php

namespace App\Policies;
use App\classes\Before;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class category_policy extends Before
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_category');
    }


    public function view(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('view_category');
    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_category');
    }


    public function update(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('update_category');
    }


    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo('delete_category');
    }


    public function restore(User $user, Category $category): bool
    {

    }


    public function forceDelete(User $user, Category $category): bool
    {

    }
}
