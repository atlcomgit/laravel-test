<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', fn (Request $request) => $request->user())->middleware('auth:sanctum');

// Тесты
Route::prefix('testing')->middleware('api')->group(base_path('routes/api-testing.php'));
