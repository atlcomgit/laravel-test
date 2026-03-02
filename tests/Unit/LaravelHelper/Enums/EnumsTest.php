<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\Enums;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Enums\HttpLogMethodEnum;
use Atlcom\LaravelHelper\Enums\HttpLogStatusEnum;
use Atlcom\LaravelHelper\Enums\HttpLogTypeEnum;
use Atlcom\LaravelHelper\Enums\ModelLogTypeEnum;
use Atlcom\LaravelHelper\Enums\QueryLogStatusEnum;
use Atlcom\LaravelHelper\Enums\QueueLogStatusEnum;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты ключевых Enum-классов пакета laravel-helper
 */
class EnumsTest extends DefaultTest
{
    /**
     * Тест ConfigEnum содержит необходимые кейсы
     * @see \Atlcom\LaravelHelper\Enums\ConfigEnum
     *
     * @return void
     */
    #[Test]
    public function configEnumHasRequiredCases(): void
    {
        $cases = ConfigEnum::cases();

        $this->assertNotEmpty($cases);

        // Проверяем наличие ключевых конфигов
        $names = array_map(static fn ($case) => $case->name, $cases);
        $this->assertContains('QueryLog', $names);
        $this->assertContains('ConsoleLog', $names);
        $this->assertContains('HttpLog', $names);
        $this->assertContains('ModelLog', $names);
        $this->assertContains('QueueLog', $names);
        $this->assertContains('RouteLog', $names);
    }


    /**
     * Тест HttpLogTypeEnum содержит типы In и Out
     * @see \Atlcom\LaravelHelper\Enums\HttpLogTypeEnum
     *
     * @return void
     */
    #[Test]
    public function httpLogTypeEnumHasInAndOut(): void
    {
        $this->assertNotNull(HttpLogTypeEnum::In);
        $this->assertNotNull(HttpLogTypeEnum::Out);
    }


    /**
     * Тест ModelLogTypeEnum содержит CRUD типы
     * @see \Atlcom\LaravelHelper\Enums\ModelLogTypeEnum
     *
     * @return void
     */
    #[Test]
    public function modelLogTypeEnumHasCrudTypes(): void
    {
        $cases = ModelLogTypeEnum::cases();
        $names = array_map(static fn ($case) => $case->name, $cases);

        $this->assertContains('Create', $names);
        $this->assertContains('Update', $names);
        $this->assertContains('Delete', $names);
    }


    /**
     * Тест QueryLogStatusEnum содержит статусы
     * @see \Atlcom\LaravelHelper\Enums\QueryLogStatusEnum
     *
     * @return void
     */
    #[Test]
    public function queryLogStatusEnumHasStatuses(): void
    {
        $cases = QueryLogStatusEnum::cases();

        $this->assertNotEmpty($cases);
    }


    /**
     * Тест QueueLogStatusEnum содержит статусы
     * @see \Atlcom\LaravelHelper\Enums\QueueLogStatusEnum
     *
     * @return void
     */
    #[Test]
    public function queueLogStatusEnumHasStatuses(): void
    {
        $cases = QueueLogStatusEnum::cases();

        $this->assertNotEmpty($cases);
    }


    /**
     * Тест HttpLogMethodEnum содержит HTTP-методы
     * @see \Atlcom\LaravelHelper\Enums\HttpLogMethodEnum
     *
     * @return void
     */
    #[Test]
    public function httpLogMethodEnumHasHttpMethods(): void
    {
        $cases = HttpLogMethodEnum::cases();
        $names = array_map(static fn ($case) => $case->name, $cases);

        // Названия кейсов — PascalCase (Get, Post, Put...)
        $this->assertContains('Get', $names);
        $this->assertContains('Post', $names);
    }


    /**
     * Тест HttpLogStatusEnum содержит статусы
     * @see \Atlcom\LaravelHelper\Enums\HttpLogStatusEnum
     *
     * @return void
     */
    #[Test]
    public function httpLogStatusEnumHasStatuses(): void
    {
        $cases = HttpLogStatusEnum::cases();

        $this->assertNotEmpty($cases);
    }
}
