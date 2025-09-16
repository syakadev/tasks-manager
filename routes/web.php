<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Models\Team;

Route::get('/', function () { return view('projects.index'); })->middleware('auth');


Route::group([
    'middleware' => ['isAuth'], // Middleware untuk semua rute dalam grup
], function () {
    Route::resource('projects', ProjectsController::class);
    Route::resource('tasks', TasksController::class);
    Route::resource('teams', TeamController::class);
    Route::get('/tasks/create/{project}', [TasksController::class, 'create'])->name('tasks.create');
    Route::resource('projects.tasks', TasksController::class);
    Route::resource('projects.teams', TeamController::class);
    Route::delete('/projects/{project}/members/{member}', [TeamController::class, 'removeMember'])->name('projects.teams.removeMember');
    Route::get('/projects/{project}/add-member', [TeamController::class, 'addMemberForm'])->name('projects.teams.addMemberForm');
    Route::post('/projects/{project}/add-member', [TeamController::class, 'storeMember'])->name('projects.teams.storeMember');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
