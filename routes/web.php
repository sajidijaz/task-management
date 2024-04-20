<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('tasks');
});

Route::middleware(['web'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('projects', ProjectController::class);
    Route::post('tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
});
