<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\SingletonService;

use App\Services\ExampleService;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Services\SingletonService;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты SingletonService — регистрация сервисов как singleton
 */
class RegisterTest extends DefaultTest
{
    /**
     * Тест что SingletonService можно резолвить из контейнера
     * @see \Atlcom\LaravelHelper\Services\SingletonService::register()
     *
     * @return void
     */
    #[Test]
    public function registerServiceWorksCorrectly(): void
    {
        $service = app(SingletonService::class);

        $this->assertInstanceOf(SingletonService::class, $service);
    }


    /**
     * Тест что ExampleService возвращает один и тот же экземпляр (singleton)
     * @see \Atlcom\LaravelHelper\Services\SingletonService::register()
     *
     * @return void
     */
    #[Test]
    public function singletonReturnsSameInstance(): void
    {
        $service1 = app(ExampleService::class);
        $service2 = app(ExampleService::class);

        // Если SingletonService зарегистрировал, должен быть тот же объект
        $this->assertSame($service1, $service2);
    }
}
