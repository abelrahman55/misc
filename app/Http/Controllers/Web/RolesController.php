<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\{DB,Session};
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;
class RolesController extends Controller
{
    //
public function index(Request $request)
    {
        // return 'erre';
        // $this->authorize('roles-عرض');
                $roles = Role::paginate(10);

        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        // $this->authorize('roles-اضافة');
        $permissions = Permission::all();
        // dd($permissions);
        return view('roles.create',compact('permissions'));
    }


    public function store(RoleRequest $request, PermissionRequest $permissionRequest)
    {
        // $this->authorize('roles-اضافة');
        if ($request->select_all) {
            $permissions = json_decode($request->select_all);
        } else {
            $permissions = $permissionRequest->permission_name;
        }

        $role = Role::create($request->validated());
        $role->syncPermissions($permissions);

        Session::flash('message', ['type' => 'success', 'text' => __('Role created successfully')]);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $roles=Role::get();
        // $this->authorize('roles-تعديل');
        $ids = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all();
        $permissionNum = $role->permissions->count();
        // return 'err';
        return view('roles.edit', compact('role','permissions','permissionNum','ids','roles'));
    }

    public function update(UpdateRoleRequest $request,PermissionRequest $req, Role $role)
    {
        // $this->authorize('roles-تعديل');

        if ($request->select_all) {
            $permissions = json_decode($request->select_all);
        } else {
            $permissions = $req->permission_name;
        }
        $role->update(['name' => $request->name]);
        $role->syncPermissions($permissions);

        Session::flash('message', ['type' => 'success', 'text' => __('Role updated successfully')]);
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
       $role = Role::findOrFail($id);
       $role->revokePermissionTo($role->permissions);
       $role->delete();
       return redirect()->route('roles.index');
    }
}
