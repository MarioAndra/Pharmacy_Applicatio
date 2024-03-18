<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\update_permissions;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Requests\u_permission\{
    U_permissionRequest
};
class RoleController extends BaseController
{
    use update_permissions;


    public function update(U_permissionRequest $request, Role $role)
    {

        $this->authorize('update', $user=Auth::user());
        return DB::transaction(function () use ($request, $role) {
            if (!$role) {
                return $this->sendError('','role not found',404);
            }
            $this->update_permission($request,$role);
            return $this->sendResponse('',"The permission for role $role->name is updated");

        });
    }





}
