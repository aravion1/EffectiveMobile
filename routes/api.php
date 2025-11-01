<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'getList']);
        Route::post('/', [TaskController::class, 'createTask']);
        Route::put('/{task}', [TaskController::class, 'updateTask']);
        Route::delete('/{task}', [TaskController::class, 'deleteTask']);
        Route::get('/{task}', [TaskController::class, 'getTask']);
    });
});