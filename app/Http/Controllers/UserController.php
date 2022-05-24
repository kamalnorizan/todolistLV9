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
}
