<?php

use App\Http\Controllers\LaravelHelper\ConsoleLogTestController;
use App\Http\Controllers\LaravelHelper\DtoTestController;
use App\Http\Controllers\LaravelHelper\HttpLogTestController;
use App\Http\Controllers\LaravelHelper\ModelLogTestController;
use App\Http\Controllers\LaravelHelper\QueryCacheTestController;
use App\Http\Controllers\LaravelHelper\QueryLogTestController;
use App\Http\Controllers\LaravelHelper\QueueLogTestController;
use App\Http\Controllers\LaravelHelper\RouteLogTestController;
use App\Http\Controllers\LaravelHelper\ViewCacheTestController;
use App\Http\Controllers\LaravelHelper\ViewLogTestController;
use App\Http\Controllers\TestController;
use Atlcom\LaravelHelper\Middlewares\HttpLogMiddleware;


Route::get('test', [TestController::class, 'test']);

Route::post('testDependencyInjectionDto', [DtoTestController::class, 'testDependencyInjectionDto']);

Route::post('testConsoleLog', [ConsoleLogTestController::class, 'testConsoleLog']);

Route::post('testHttpLogIn', [HttpLogTestController::class, 'testHttpLogIn'])->middleware(HttpLogMiddleware::class);
Route::post('testHttpLogOut', [HttpLogTestController::class, 'testHttpLogOut']);

Route::post('testModelLogEloquentCreate', [ModelLogTestController::class, 'testModelLogEloquentCreate']);
Route::post('testModelLogEloquentInsert', [ModelLogTestController::class, 'testModelLogEloquentInsert']);
Route::post('testModelLogEloquentUpdate', [ModelLogTestController::class, 'testModelLogEloquentUpdate']);
Route::post('testModelLogEloquentDelete', [ModelLogTestController::class, 'testModelLogEloquentDelete']);
Route::post('testModelLogEloquentForceDelete', [ModelLogTestController::class, 'testModelLogEloquentForceDelete']);
Route::post('testModelLogEloquentTruncate', [ModelLogTestController::class, 'testModelLogEloquentTruncate']);
Route::post('testModelLogDatabaseInsert', [ModelLogTestController::class, 'testModelLogDatabaseInsert']);
Route::post('testModelLogDatabaseUpdate', [ModelLogTestController::class, 'testModelLogDatabaseUpdate']);
Route::post('testModelLogDatabaseDelete', [ModelLogTestController::class, 'testModelLogDatabaseDelete']);
Route::post('testModelLogDatabaseTruncate', [ModelLogTestController::class, 'testModelLogDatabaseTruncate']);

Route::post('testQueryLogDbSelectWithoutLog', [QueryLogTestController::class, 'testQueryLogDbSelectWithoutLog']);
Route::post('testQueryLogDbSelectWithLog', [QueryLogTestController::class, 'testQueryLogDbSelectWithLog']);
Route::post('testQueryLogDbStatementWithoutLog', [QueryLogTestController::class, 'testQueryLogDbStatementWithoutLog']);
Route::post('testQueryLogDbStatementWithLog', [QueryLogTestController::class, 'testQueryLogDbStatementWithLog']);
Route::post('testQueryLogDatabaseGetWithoutLog', [QueryLogTestController::class, 'testQueryLogDatabaseGetWithoutLog']);
Route::post('testQueryLogDatabaseGetWithLog', [QueryLogTestController::class, 'testQueryLogDatabaseGetWithLog']);
Route::post('testQueryLogDatabaseUpdateWithoutLog', [QueryLogTestController::class, 'testQueryLogDatabaseUpdateWithoutLog']);
Route::post('testQueryLogDatabaseUpdateWithLog', [QueryLogTestController::class, 'testQueryLogDatabaseUpdateWithLog']);
Route::post('testQueryLogDatabaseDeleteWithoutLog', [QueryLogTestController::class, 'testQueryLogDatabaseDeleteWithoutLog']);
Route::post('testQueryLogDatabaseDeleteWithLog', [QueryLogTestController::class, 'testQueryLogDatabaseDeleteWithLog']);
Route::post('testQueryLogDatabaseInsertWithoutLog', [QueryLogTestController::class, 'testQueryLogDatabaseInsertWithoutLog']);
Route::post('testQueryLogDatabaseInsertWithLog', [QueryLogTestController::class, 'testQueryLogDatabaseInsertWithLog']);
Route::post('testQueryLogEloquentBuilderFindWithoutLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderFindWithoutLog']);
Route::post('testQueryLogEloquentBuilderFindWithLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderFindWithLog']);
Route::post('testQueryLogEloquentBuilderFirstWithoutLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderFirstWithoutLog']);
Route::post('testQueryLogEloquentBuilderFirstWithLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderFirstWithLog']);
Route::post('testQueryLogEloquentBuilderGetWithoutLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderGetWithoutLog']);
Route::post('testQueryLogEloquentBuilderGetWithLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderGetWithLog']);
Route::post('testQueryLogEloquentBuilderCreateWithoutLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderCreateWithoutLog']);
Route::post('testQueryLogEloquentBuilderCreateWithLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderCreateWithLog']);
Route::post('testQueryLogEloquentBuilderUpdateWithoutLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderUpdateWithoutLog']);
Route::post('testQueryLogEloquentBuilderUpdateWithLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderUpdateWithLog']);
Route::post('testQueryLogEloquentBuilderDeleteWithoutLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderDeleteWithoutLog']);
Route::post('testQueryLogEloquentBuilderDeleteWithLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderDeleteWithLog']);
Route::post('testQueryLogEloquentBuilderTruncateWithoutLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderDeleteWithoutLog']);
Route::post('testQueryLogEloquentBuilderTruncateWithLog', [QueryLogTestController::class, 'testQueryLogEloquentBuilderDeleteWithLog']);

Route::post('testQueryCacheDbSelectWithoutLog', [QueryCacheTestController::class, 'testQueryCacheDbSelectWithoutLog']);
Route::post('testQueryCacheDbSelectWithLog', [QueryCacheTestController::class, 'testQueryCacheDbSelectWithLog']);
Route::post('testQueryCacheDbStatementWithoutLog', [QueryCacheTestController::class, 'testQueryCacheDbStatementWithoutLog']);
Route::post('testQueryCacheDbStatementWithLog', [QueryCacheTestController::class, 'testQueryCacheDbStatementWithLog']);
Route::post('testQueryCacheDatabaseGetWithoutLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseGetWithoutLog']);
Route::post('testQueryCacheDatabaseGetWithLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseGetWithLog']);
Route::post('testQueryCacheDatabaseUpdateWithoutLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseUpdateWithoutLog']);
Route::post('testQueryCacheDatabaseUpdateWithLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseUpdateWithLog']);
Route::post('testQueryCacheDatabaseDeleteWithoutLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseDeleteWithoutLog']);
Route::post('testQueryCacheDatabaseDeleteWithLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseDeleteWithLog']);
Route::post('testQueryCacheDatabaseInsertWithoutLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseInsertWithoutLog']);
Route::post('testQueryCacheDatabaseInsertWithLog', [QueryCacheTestController::class, 'testQueryCacheDatabaseInsertWithLog']);
Route::post('testQueryCacheEloquentBuilderFindWithoutLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderFindWithoutLog']);
Route::post('testQueryCacheEloquentBuilderFindWithLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderFindWithLog']);
Route::post('testQueryCacheEloquentBuilderFirstWithoutLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderFirstWithoutLog']);
Route::post('testQueryCacheEloquentBuilderFirstWithLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderFirstWithLog']);
Route::post('testQueryCacheEloquentBuilderGetWithoutLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderGetWithoutLog']);
Route::post('testQueryCacheEloquentBuilderGetWithLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderGetWithLog']);
Route::post('testQueryCacheEloquentBuilderCreateWithoutLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderCreateWithoutLog']);
Route::post('testQueryCacheEloquentBuilderCreateWithLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderCreateWithLog']);
Route::post('testQueryCacheEloquentBuilderUpdateWithoutLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderUpdateWithoutLog']);
Route::post('testQueryCacheEloquentBuilderUpdateWithLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderUpdateWithLog']);
Route::post('testQueryCacheEloquentBuilderDeleteWithoutLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderDeleteWithoutLog']);
Route::post('testQueryCacheEloquentBuilderDeleteWithLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderDeleteWithLog']);
Route::post('testQueryCacheEloquentBuilderTruncateWithoutLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderDeleteWithoutLog']);
Route::post('testQueryCacheEloquentBuilderTruncateWithLog', [QueryCacheTestController::class, 'testQueryCacheEloquentBuilderDeleteWithLog']);

Route::post('testQueueLogWithoutLog', [QueueLogTestController::class, 'testQueueLogWithoutLog']);
Route::post('testQueueLogWithLog', [QueueLogTestController::class, 'testQueueLogWithLog']);

Route::post('testRouteLog', [RouteLogTestController::class, 'testRouteLog']);

Route::post('testViewLogWithoutLog', [ViewLogTestController::class, 'testViewLogWithoutLog']);
Route::post('testViewLogWithLog', [ViewLogTestController::class, 'testViewLogWithLog']);

Route::post('testViewCacheWithoutLog', [ViewCacheTestController::class, 'testViewCacheWithoutLog']);
Route::post('testViewCacheWithLog', [ViewCacheTestController::class, 'testViewCacheWithLog']);
