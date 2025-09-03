<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () { return view('welcome'); })->middleware('auth');


Route::group([
    'middleware' => ['isAuth'], // Middleware untuk semua rute dalam gru
], function () {
    Route::resource('projects', ProjectsController::class);
    Route::resource('tasks', TasksController::class);
    Route::get('/tasks/create/{project}', [TasksController::class, 'create'])->name('tasks.create');
    Route::resource('projects.tasks', TasksController::class);
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
