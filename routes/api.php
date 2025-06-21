<?php

use App\Http\Controllers\TestController;
use Atlcom\LaravelHelper\Middlewares\HttpLogMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', fn (Request $request) => $request->user())->middleware('auth:sanctum');

Route::prefix('testing')->group(static function () {
    Route::get('/test', [TestController::class, 'test']);

    Route::post('/testDependencyInjectionDto', [TestController::class, 'testDependencyInjectionDto']);

    Route::post('/testConsoleLog', [TestController::class, 'testConsoleLog']);

    Route::post('/testHttpLogIn', [TestController::class, 'testHttpLogIn'])->middleware(HttpLogMiddleware::class);
    Route::post('/testHttpLogOut', [TestController::class, 'testHttpLogOut']);

    Route::post('/testModelLogCreate', [TestController::class, 'testModelLogCreate']);
    Route::post('/testModelLogInsert', [TestController::class, 'testModelLogInsert']);
    Route::post('/testModelLogUpdate', [TestController::class, 'testModelLogUpdate']);
    Route::post('/testModelLogDelete', [TestController::class, 'testModelLogDelete']);
    Route::post('/testModelLogForceDelete', [TestController::class, 'testModelLogForceDelete']);

    Route::post('/testQueryLog', [TestController::class, 'testQueryLog']);

    Route::post('/testQueueLog', [TestController::class, 'testQueueLog']);

    Route::post('/testRouteLog', [TestController::class, 'testRouteLog']);

    Route::post('/testViewLog', [TestController::class, 'testViewLog']);
});