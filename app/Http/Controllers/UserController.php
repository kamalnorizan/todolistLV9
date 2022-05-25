<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('user.index',compact('users','roles','permissions'));
    }

    public function index2()
    {
        // $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();
        return view('user.index2',compact('roles','permissions'));
    }

    public function ajaxLoadUserTable(Request $request)
    {
        $users=User::select('*');
        $roles = Role::all();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('rolespermission', function(User $user){
                $badges='';
                foreach ($user->roles as $key => $role) {
                    $badges.= '<span class="badge badge-primary"> '.$role->name.' </span>';
                }

                return $badges;
            })
            ->addColumn('action', function(User $user) use ($roles){
                $buttons='';
                foreach ($roles as $role){
                    $buttons=$buttons.'<button class="dropdown-item assignroletouser-btn" data-roleid="'.$role->id.'" data-userid="'.$user->id.'">'.$role->name.'</button>';
                }
                $dropdown = '<div class="dropdown open">';
                $dropdown .=     '<button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Assign Role</button>';
                $dropdown .=   '<div class="dropdown-menu" aria-labelledby="triggerId">';
                $dropdown .= $buttons;
                $dropdown .=     '</div>';
                $dropdown .= '</div>';
                return $dropdown;
            })
            ->rawColumns(['rolespermission','action'])
            ->make(true);
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
