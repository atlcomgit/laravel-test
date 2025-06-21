<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ModelLogTypeEnum;
use Atlcom\LaravelHelper\Models\ModelLog;
use PHPUnit\Framework\Attributes\Test;

class ModelLogTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testModelLogCreate()
     *
     * @return void
     */
    #[Test]
    public function testModelLogCreate(): void
    {
        $this->call('POST', '/api/testing/testModelLogCreate')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Create)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testModelLogInsert()
     *
     * @return void
     */
    #[Test]
    public function testModelLogInsert(): void
    {
        $this->call('POST', '/api/testing/testModelLogInsert')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Create)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testModelLogUpdate()
     *
     * @return void
     */
    #[Test]
    public function testModelLogUpdate(): void
    {
        $this->call('POST', '/api/testing/testModelLogUpdate')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Update)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testModelLogDelete()
     *
     * @return void
     */
    #[Test]
    public function testModelLogDelete(): void
    {
        $this->call('POST', '/api/testing/testModelLogDelete')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::SoftDelete)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testModelLogForceDelete()
     *
     * @return void
     */
    #[Test]
    public function testModelLogForceDelete(): void
    {
        $this->call('POST', '/api/testing/testModelLogForceDelete')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Delete)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }
}