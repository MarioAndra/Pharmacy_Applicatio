<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    public function run(): void
    {

        $roles = ['owner', 'admin', 'super_admin', 'supervisor'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }


        $permissions = [
            'create_user', 'update_user', 'delete_user', 'view_user',
            'create_product', 'update_product', 'delete_product', 'view_product',
            'create_category', 'update_category', 'delete_category', 'view_category'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        $allPermissions = Permission::all('id')->pluck('id')->toArray();
        foreach ($roles as $role) {
            $roleModel = Role::where('name', $role)->first();
            $roleModel->permissions()->create($allPermissions);
        }

        $u_permission = Permission::create(['name' => 'u_permission']);
        $ownerRole = Role::where('name', 'owner')->first();
        $ownerRole->permissions()->create($u_permission->id);
    }
}
