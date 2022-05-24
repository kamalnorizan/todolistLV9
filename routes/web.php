<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// DB::listen(function ($event) {
//     dump($event->sql);
// });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/todolist', [TodolistController::class,'index']);
    Route::get('/todolist/lazyeager', [TodolistController::class,'lazyeager']);
    Route::get('/todolist/polyrel', [TodolistController::class,'polyrel']);
    Route::get('/todolist/polyreltask', [TodolistController::class,'polyreltask']);
    Route::get('/todolist/todolistScope', [TodolistController::class,'todolistScope']);
    Route::get('/todolist/localScope', [TodolistController::class,'localScope']);
    Route::get('/todolist/{todolist}', [TodolistController::class,'show']);

    //User management module
    Route::get('user', [UserController::class,'index'])->name('user.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
