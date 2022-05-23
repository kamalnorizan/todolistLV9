<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Http\Requests\StoreTodolistRequest;
use App\Http\Requests\UpdateTodolistRequest;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolists = Todolist::with('user')->get();
        foreach ($todolists as $key => $todolist) {
            echo $todolist->user->name.' - '.$todolist->title.'<br>';
            // $todolist->load('tasks');
            foreach ($todolist->tasks as $key => $task) {
               echo '  - '.$task->description.'<br>';
            }
            echo '<br>';
        }
    }

    public function lazyeager()
    {
        $todolists = Todolist::with('user')->get();
        foreach ($todolists as $key => $todolist) {
            echo $todolist->user->name.' - '.$todolist->title.'<br>';
            // $todolist->load('user.todolists');
            foreach ($todolist->user->todolists as $key => $todolistNest) {
               echo '  - '.$todolistNest->title.'<br>';
               if($todolistNest->id < 10){
                    $todolistNest->load('user');
               }
            }
            echo '<br>';
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodolistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodolistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodolistRequest  $request
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodolistRequest $request, Todolist $todolist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        //
    }
}
