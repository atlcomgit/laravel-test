<?php

use App\Http\Controllers\TestController;
use Atlcom\LaravelHelper\Middlewares\HttpLogMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', [TestController::class, 'test'])
    ->middleware(HttpLogMiddleware::class);
