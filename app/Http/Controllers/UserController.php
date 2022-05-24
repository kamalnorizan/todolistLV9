<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('user.index',compact('users','roles','permissions'));
    }

    public function storeRole(Request $request)
    {
        $role = new Role;
        $role->name = $request->role;
        $role->save();

        return response()->json(['status'=>'success']);
    }

    public function storePermission(Request $request)
    {
        $permission = new Permission;
        $permission->name = $request->permission;
        $permission->save();

        return response()->json(['status'=>'success']);
    }

    public function getRolePermissions(Request $request)
    {
        $role = Role::find($request->id);
        $permissions = $role->permissions;

        $data['permissions']=$permissions;

        return response()->json($data);
    }

    public function roleassignpermission(Request $request)
    {
        $role = Role::find($request->role);
        $role->givePermissionTo($request->permission);
        $data['permissions'] = $role->permissions;
        return response()->json($data);
    }

    public function userassignrole(Request $request)
    {
        $user = User::find($request->userid);
        $role = Role::find($request->roleid);
        $user->assignRole($role);

        return response()->json(['status'=>'success']);
    }
}
