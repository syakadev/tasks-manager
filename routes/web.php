<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('projects', ProjectsController::class);
Route::resource('tasks', TasksController::class);
// routes/web.php
// Route::get('/projects/{project}/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
// Route yang benar
Route::get('/tasks/create/{project}', [TasksController::class, 'create'])->name('tasks.create');



// Route::get('/tasks/edit/{project}/{task}', [TasksController::class, 'edit'])->name('tasks.edit');

// Route::PUT('/tasks/update/{project}/{task}', [TasksController::class, 'update'])->name('tasks.update');
// Route::get('/tasks/delete/{project}/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
Route::resource('projects.tasks', TasksController::class);

