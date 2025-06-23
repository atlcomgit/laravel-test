<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ModelLogTypeEnum;
use Atlcom\LaravelHelper\Models\ModelLog;
use PHPUnit\Framework\Attributes\Test;

class ModelLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        \App\Models\Test::truncate();
        ModelLog::query()->truncate();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogEloquentCreate()
     *
     * @return void
     */
    #[Test]
    public function testModelLogEloquentCreate(): void
    {
        $this->call('POST', '/api/testing/testModelLogEloquentCreate')
            ->assertSuccessful();

        $count = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Create)
            ->count();
        $this->assertSame(1, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogEloquentInsert()
     *
     * @return void
     */
    #[Test]
    public function testModelLogEloquentInsert(): void
    {
        $this->call('POST', '/api/testing/testModelLogEloquentInsert')
            ->assertSuccessful();

        $count = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Create)
            ->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogEloquentUpdate()
     *
     * @return void
     */
    #[Test]
    public function testModelLogEloquentUpdate(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testModelLogEloquentUpdate')
            ->assertSuccessful();

        $count = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Update)
            ->count();
        $this->assertSame(1, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogEloquentDelete()
     *
     * @return void
     */
    #[Test]
    public function testModelLogEloquentDelete(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testModelLogEloquentDelete')
            ->assertSuccessful();

        $count = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::SoftDelete)
            ->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogEloquentForceDelete()
     *
     * @return void
     */
    #[Test]
    public function testModelLogEloquentForceDelete(): void
    {
        \App\Models\Test::factory()->create();

        $this->call('POST', '/api/testing/testModelLogEloquentForceDelete')
            ->assertSuccessful();

        $count = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Delete)
            ->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogEloquentTruncate()
     *
     * @return void
     */
    #[Test]
    public function testModelLogEloquentTruncate(): void
    {
        \App\Models\Test::factory(2)->create();

        $this->call('POST', '/api/testing/testModelLogEloquentTruncate')
            ->assertSuccessful();

        $count = ModelLog::query()->count();
        $this->assertSame(4, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogDatabaseInsert()
     *
     * @return void
     */
    #[Test]
    public function testModelLogDatabaseInsert(): void
    {
        \App\Models\Test::factory(2)->create();

        $this->call('POST', '/api/testing/testModelLogDatabaseInsert')
            ->assertSuccessful();

        $count = ModelLog::query()->count();
        $this->assertSame(2, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogDatabaseUpdate()
     *
     * @return void
     */
    #[Test]
    public function testModelLogDatabaseUpdate(): void
    {
        \App\Models\Test::factory(2)->create();

        $this->call('POST', '/api/testing/testModelLogDatabaseUpdate')
            ->assertSuccessful();

        $count = ModelLog::query()->count();
        $this->assertSame(4, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogDatabaseDelete()
     *
     * @return void
     */
    #[Test]
    public function testModelLogDatabaseDelete(): void
    {
        \App\Models\Test::factory(2)->create();

        $this->call('POST', '/api/testing/testModelLogDatabaseDelete')
            ->assertSuccessful();

        $count = ModelLog::query()->count();
        $this->assertSame(4, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ModelLogTestController::testModelLogDatabaseTruncate()
     *
     * @return void
     */
    #[Test]
    public function testModelLogDatabaseTruncate(): void
    {
        \App\Models\Test::factory(2)->create();

        $this->call('POST', '/api/testing/testModelLogDatabaseTruncate')
            ->assertSuccessful();

        $count = ModelLog::query()->count();
        $this->assertSame(2, $count);
    }
}
