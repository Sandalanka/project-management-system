<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Comment\CommentController;


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('me', [AuthController::class, 'me']);
       });
    });

    Route::prefix('projects')->middleware(['auth:sanctum'])->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('{projectId}', [ProjectController::class, 'getById']);
        Route::get('{project_id}/tasks', [TaskController::class, 'index']);

        Route::middleware('role:admin')->group(function () {
            Route::post('/', [ProjectController::class, 'store']);
            Route::put('{projectId}', [ProjectController::class, 'update']);
            Route::delete('{projectId}', [ProjectController::class, 'destroy']);
       });

        Route::middleware('role:manager')->group(function () {
            Route::post('{project_id}/tasks', [TaskController::class, 'store']);
        });
    }); 
    
    Route::prefix('tasks')->middleware(['auth:sanctum'])->group(function () {
        Route::get('{taskId}', [TaskController::class, 'getById']);
         Route::put('{taskId}', [TaskController::class, 'update']);
         Route::get('{taskId}/comment', [CommentController::class, 'index']);
         Route::post('{taskId}/comment', [CommentController::class, 'store']);

        Route::middleware('role:manager')->group(function () {
            Route::delete('{taskId}', [TaskController::class, 'destroy']);
        });
    });
});
