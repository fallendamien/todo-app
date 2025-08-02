<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Todo API Endpoints
Route::apiResource('todos', TodoController::class);

// Custom route for toggling completion status
Route::patch('todos/{id}/toggle', [TodoController::class, 'toggle']);
