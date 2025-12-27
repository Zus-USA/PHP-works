<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('task.list');
});

Route::get('/task/list', [TaskController::class, 'list'])->name('task.list');
Route::match(['get', 'post'], '/task/add', [TaskController::class, 'add'])->name('task.add');
