<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getTasks()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }
}
