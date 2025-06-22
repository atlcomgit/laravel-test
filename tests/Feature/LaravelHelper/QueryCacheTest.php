<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\QueryLog;
use Atlcom\LaravelHelper\Services\QueryCacheService;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;

class QueryCacheTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        \App\Models\Test::truncate();
        QueryLog::query()->truncate();
        app(QueryCacheService::class)->flushQueryCacheAll();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDbSelectWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDbSelectWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDbSelectWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDbSelectWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDbSelectWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDbSelectWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(2, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDbStatementWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDbStatementWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDbStatementWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDbStatementWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDbStatementWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDbStatementWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseGetWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseGetWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseGetWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseGetWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseGetWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseGetWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(1, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(3, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseUpdateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseUpdateWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseUpdateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseUpdateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseUpdateWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseUpdateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(3, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(1, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseDeleteWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseDeleteWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseDeleteWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseDeleteWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseDeleteWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseDeleteWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(3, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseInsertWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseInsertWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseInsertWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheDatabaseInsertWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheDatabaseInsertWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheDatabaseInsertWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(3, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(1, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderFindWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderFindWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderFindWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderFindWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderFindWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderFindWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(2, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(4, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderFirstWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderFirstWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderFirstWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderFirstWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderFirstWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderFirstWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(1, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(3, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderGetWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderGetWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderGetWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderGetWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderGetWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderGetWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(1, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(3, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderCreateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderCreateWithoutLog(): void
    {
        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderCreateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderCreateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderCreateWithLog(): void
    {
        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderCreateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(3, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderUpdateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderUpdateWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderUpdateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderUpdateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderUpdateWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderUpdateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(3, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderDeleteWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderDeleteWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderDeleteWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderDeleteWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderDeleteWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderDeleteWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(4, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(3, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderTruncateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderTruncateWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderTruncateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached')->count();
        $this->assertSame(0, $count);

        $count = QueryLog::query()->where('is_from_cache')->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryCacheTestController::testQueryCacheEloquentBuilderTruncateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryCacheEloquentBuilderTruncateWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryCacheEloquentBuilderTruncateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->where('is_cached', true)->count();
        $this->assertSame(4, $count);

        $count = QueryLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(3, $count);
    }
}
