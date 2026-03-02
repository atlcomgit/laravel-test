<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\Models;

use App\Models\Test as TestModel;
use App\Models\User;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\ConsoleLog;
use Atlcom\LaravelHelper\Models\HttpLog;
use Atlcom\LaravelHelper\Models\ModelLog;
use Atlcom\LaravelHelper\Models\ProfilerLog;
use Atlcom\LaravelHelper\Models\QueryLog;
use Atlcom\LaravelHelper\Models\QueueLog;
use Atlcom\LaravelHelper\Models\RouteLog;
use Atlcom\LaravelHelper\Models\ViewLog;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты моделей логов — проверка что все модели доступны и корректно работают
 */
class LogModelsTest extends DefaultTest
{
    /**
     * Тест что ConsoleLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\ConsoleLog
     *
     * @return void
     */
    #[Test]
    public function consoleLogModelWorks(): void
    {
        $tableName = ConsoleLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('console_logs', $tableName);
    }


    /**
     * Тест что HttpLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\HttpLog
     *
     * @return void
     */
    #[Test]
    public function httpLogModelWorks(): void
    {
        $tableName = HttpLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('http_logs', $tableName);
    }


    /**
     * Тест что ModelLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\ModelLog
     *
     * @return void
     */
    #[Test]
    public function modelLogModelWorks(): void
    {
        $tableName = ModelLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('model_logs', $tableName);
    }


    /**
     * Тест что QueryLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\QueryLog
     *
     * @return void
     */
    #[Test]
    public function queryLogModelWorks(): void
    {
        $tableName = QueryLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('query_logs', $tableName);
    }


    /**
     * Тест что QueueLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\QueueLog
     *
     * @return void
     */
    #[Test]
    public function queueLogModelWorks(): void
    {
        $tableName = QueueLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('queue_logs', $tableName);
    }


    /**
     * Тест что RouteLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\RouteLog
     *
     * @return void
     */
    #[Test]
    public function routeLogModelWorks(): void
    {
        $tableName = RouteLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('route_logs', $tableName);
    }


    /**
     * Тест что ViewLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\ViewLog
     *
     * @return void
     */
    #[Test]
    public function viewLogModelWorks(): void
    {
        $tableName = ViewLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('view_logs', $tableName);
    }


    /**
     * Тест что ProfilerLog модель корректно инстанциируется
     * @see \Atlcom\LaravelHelper\Models\ProfilerLog
     *
     * @return void
     */
    #[Test]
    public function profilerLogModelWorks(): void
    {
        $tableName = ProfilerLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('profiler_logs', $tableName);
    }


    /**
     * Тест что приложенческая модель Test корректно работает
     * @see \App\Models\Test
     *
     * @return void
     */
    #[Test]
    public function appTestModelCrud(): void
    {
        // Create
        $model = TestModel::factory()->create(['name' => 'CRUD тест']);
        $this->assertDatabaseHas('tests', ['name' => 'CRUD тест']);

        // Read
        $found = TestModel::query()->find($model->id);
        $this->assertNotNull($found);
        $this->assertSame('CRUD тест', $found->name);

        // Update
        $found->update(['name' => 'Обновлённый']);
        $this->assertDatabaseHas('tests', ['name' => 'Обновлённый']);

        // Delete (SoftDeletes)
        $found->delete();
        $this->assertSoftDeleted('tests', ['id' => $model->id]);

        // ForceDelete
        $found->forceDelete();
        $this->assertDatabaseMissing('tests', ['id' => $model->id]);
    }


    /**
     * Тест фабрики пользователя
     * @see \App\Models\User
     *
     * @return void
     */
    #[Test]
    public function userModelFactory(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->id);
        $this->assertNotNull($user->email);
        $this->assertNotNull($user->name);
    }
}
