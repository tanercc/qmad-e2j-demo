<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('{project}', [ProjectController::class, 'show']);

    Route::get('{project}/tasks', [TaskController::class, 'index']);
    Route::get('{project}/tasks/{task}', [TaskController::class, 'show']);
    Route::post('{project}/tasks', [TaskController::class, 'store']);
    Route::put('{project}/tasks', [TaskController::class, 'update']);
    Route::delete('{project}/tasks/{task}', [TaskController::class, 'destroy']);
});

Route::resource('resources', ResourceController::class);
