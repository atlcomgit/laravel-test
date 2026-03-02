<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\Helpers;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты глобальных функций-помощников из helpers.php
 */
class HelpersTest extends DefaultTest
{
    /**
     * Тест функции isDebug
     * @see isDebug()
     *
     * @return void
     */
    #[Test]
    public function isDebugReturnsBool(): void
    {
        $result = isDebug();

        $this->assertIsBool($result);
    }


    /**
     * Тест функции isLocal
     * @see isLocal()
     *
     * @return void
     */
    #[Test]
    public function isLocalReturnsBool(): void
    {
        $result = isLocal();

        $this->assertIsBool($result);
    }


    /**
     * Тест функции isDev
     * @see isDev()
     *
     * @return void
     */
    #[Test]
    public function isDevReturnsBool(): void
    {
        $result = isDev();

        $this->assertIsBool($result);
    }


    /**
     * Тест функции isTesting
     * @see isTesting()
     *
     * @return void
     */
    #[Test]
    public function isTestingReturnsTrue(): void
    {
        // В тестовом окружении isTesting() должно вернуть true
        $result = isTesting();

        $this->assertTrue($result);
    }


    /**
     * Тест функции isProd
     * @see isProd()
     *
     * @return void
     */
    #[Test]
    public function isProdReturnsBool(): void
    {
        $result = isProd();

        $this->assertIsBool($result);
        // В тестовом окружении продакшен должен быть отключён
        $this->assertFalse($result);
    }


    /**
     * Тест функции isCommand
     * @see isCommand()
     *
     * @return void
     */
    #[Test]
    public function isCommandReturnsBool(): void
    {
        $result = isCommand();

        $this->assertIsBool($result);
    }


    /**
     * Тест функции isHttp
     * @see isHttp()
     *
     * @return void
     */
    #[Test]
    public function isHttpReturnsBool(): void
    {
        $result = isHttp();

        $this->assertIsBool($result);
    }


    /**
     * Тест функции uuid
     * @see uuid()
     *
     * @return void
     */
    #[Test]
    public function uuidReturnsValidUuid(): void
    {
        $uuid = uuid();

        $this->assertIsString($uuid);
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            $uuid,
        );
    }


    /**
     * Тест функции uuid возвращает уникальные значения
     * @see uuid()
     *
     * @return void
     */
    #[Test]
    public function uuidGeneratesUniqueValues(): void
    {
        $uuid1 = uuid();
        $uuid2 = uuid();

        $this->assertNotSame($uuid1, $uuid2);
    }


    /**
     * Тест функции json
     * @see json()
     *
     * @return void
     */
    #[Test]
    public function jsonReturnsJsonString(): void
    {
        $data = ['key' => 'value', 'number' => 42];

        $result = json($data);

        $this->assertIsString($result);
        $decoded = json_decode($result, true);
        $this->assertSame('value', $decoded['key']);
        $this->assertSame(42, $decoded['number']);
    }


    /**
     * Тест функции lhConfig
     * @see lhConfig()
     *
     * @return void
     */
    #[Test]
    public function lhConfigReturnsConfigValue(): void
    {
        $result = lhConfig(\Atlcom\LaravelHelper\Enums\ConfigEnum::App, 'debug');

        $this->assertIsBool($result);
    }


    /**
     * Тест функции sql с Builder
     * @see sql()
     *
     * @return void
     */
    #[Test]
    public function sqlReturnsStringFromBuilder(): void
    {
        $builder = \App\Models\Test::query()->where('id', 1);

        $result = sql($builder);

        $this->assertIsString($result);
        $this->assertStringContainsString('tests', $result);
        $this->assertStringContainsString('id', $result);
    }
}
