<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\LaravelHelperService;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Facades\Lh;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты методов LaravelHelperService через фасад Lh
 */
class ConfigTest extends DefaultTest
{
    /**
     * Тест получения конфигурации через фасад Lh
     * @see \Atlcom\LaravelHelper\Services\LaravelHelperService::config()
     *
     * @return void
     */
    #[Test]
    public function configReturnsValueForQueryLog(): void
    {
        $result = Lh::config(ConfigEnum::QueryLog, 'enabled');

        $this->assertIsBool($result);
    }


    /**
     * Тест получения конфигурации ConsoleLog
     * @see \Atlcom\LaravelHelper\Services\LaravelHelperService::config()
     *
     * @return void
     */
    #[Test]
    public function configReturnsValueForConsoleLog(): void
    {
        $result = Lh::config(ConfigEnum::ConsoleLog, 'enabled');

        $this->assertIsBool($result);
    }


    /**
     * Тест получения конфигурации HttpLog
     * @see \Atlcom\LaravelHelper\Services\LaravelHelperService::config()
     *
     * @return void
     */
    #[Test]
    public function configReturnsValueForHttpLog(): void
    {
        $result = Lh::config(ConfigEnum::HttpLog, 'enabled');

        $this->assertNotNull($result);
    }


    /**
     * Тест получения имени таблицы через Lh
     * @see \Atlcom\LaravelHelper\Services\LaravelHelperService::getTable()
     *
     * @return void
     */
    #[Test]
    public function getTableReturnsTableName(): void
    {
        $tableName = Lh::getTable(ConfigEnum::QueryLog);

        $this->assertIsString($tableName);
        $this->assertStringContainsString('query_logs', $tableName);
    }


    /**
     * Тест получения соединения через Lh
     * @see \Atlcom\LaravelHelper\Services\LaravelHelperService::getConnection()
     *
     * @return void
     */
    #[Test]
    public function getConnectionReturnsString(): void
    {
        $connection = Lh::getConnection(ConfigEnum::QueryLog);

        $this->assertTrue(
            is_string($connection) || is_null($connection)
        );
    }


    /**
     * Тест проверки конфигурации
     * @see \Atlcom\LaravelHelper\Services\LaravelHelperService::checkConfig()
     *
     * @return void
     */
    #[Test]
    public function checkConfigDoesNotThrow(): void
    {
        // Не должно выбрасывать исключение при валидном конфиге
        Lh::checkConfig();

        $this->assertTrue(true);
    }
}
