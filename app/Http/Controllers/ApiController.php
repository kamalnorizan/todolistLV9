<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
class ApiController extends Controller
{
    public function getTasks()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }
}
