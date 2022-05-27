<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Auth;
class ApiController extends Controller
{
    public function getTasks()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required|min:8',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        return response()->json(['status'=>'successful'], 200);
    }

    public function login(Request $request)
    {
        $data = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(auth()->attempt($data)){
            $token = auth()->user()->createToken('Client Mobile Apps');
            return response()->json(['token'=>$token], 200);
        }else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['status'=>'successful'], 200);
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }
}
