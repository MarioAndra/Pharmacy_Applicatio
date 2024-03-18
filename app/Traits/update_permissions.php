<?php
namespace App\Traits;
use App\Models\Permission;
use App\Http\Controllers\BaseController;
trait update_permissions{
    public function update_permission($request,$role){

        $permissions = $request->input('permissions');
        $existing_PermissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $role->permissions()->sync($existing_PermissionIds);


    }
}
