<?php

namespace App\Policies;
use App\Models\Product;
use App\Models\User;
use App\classes\Before;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
class product_policy extends Before
{

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_product');
    }


    public function view(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('view_product');
    }


    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_product');
    }


    public function update(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('update_product')||$usre->id==$product->user_id;
    }


    public function delete(User $user, Product $product): bool
    {
        return $user->hasPermissionTo('delete_product')||$usre->id==$product->user_id;
    }


}
