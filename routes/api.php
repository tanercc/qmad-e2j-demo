<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\StatusController;
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

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('{order}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('/', [OrderController::class, 'update']);
    Route::delete('{orderID}', [OrderController::class, 'destroy']);
});

Route::resource('resources', ResourceController::class);
Route::resource('statuses', StatusController::class);
Route::resource('customers', CustomerController::class);
