<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\QueryLog;
use PHPUnit\Framework\Attributes\Test;

class QueryLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        \App\Models\Test::truncate();
        QueryLog::query()->truncate();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDbSelectWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDbSelectWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDbSelectWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDbSelectWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDbSelectWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDbSelectWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDbStatementWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDbStatementWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDbStatementWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDbStatementWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDbStatementWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDbStatementWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(1, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseGetWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseGetWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseGetWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseGetWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseGetWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseGetWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseUpdateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseUpdateWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseUpdateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseUpdateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseUpdateWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseUpdateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseDeleteWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseDeleteWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseDeleteWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseDeleteWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseDeleteWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseDeleteWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseInsertWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseInsertWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseInsertWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogDatabaseInsertWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogDatabaseInsertWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogDatabaseInsertWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderFindWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderFindWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderFindWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderFindWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderFindWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderFindWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderFirstWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderFirstWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderFirstWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderFirstWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderFirstWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderFirstWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderGetWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderGetWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderGetWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderGetWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderGetWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderGetWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderCreateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderCreateWithoutLog(): void
    {
        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderCreateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderCreateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderCreateWithLog(): void
    {
        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderCreateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderUpdateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderUpdateWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderUpdateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderUpdateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderUpdateWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderUpdateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderDeleteWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderDeleteWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderDeleteWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderDeleteWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderDeleteWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderDeleteWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderTruncateWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderTruncateWithoutLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderTruncateWithoutLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueryLogTestController::testQueryLogEloquentBuilderTruncateWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLogEloquentBuilderTruncateWithLog(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testQueryLogEloquentBuilderTruncateWithLog')
            ->assertSuccessful();

        $count = QueryLog::query()->count();
        $this->assertSame(2, $count);
    }
}
