<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\DefaultController;

use Atlcom\LaravelHelper\Defaults\DefaultController;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты класса DefaultController — кеширование и логирование view
 */
class WithViewCacheTest extends DefaultTest
{
    /**
     * Тест метода withViewCache (алиас withCache)
     * @see \Atlcom\LaravelHelper\Defaults\DefaultController::withViewCache()
     *
     * @return void
     */
    #[Test]
    public function withViewCacheReturnsSelf(): void
    {
        // Создаём анонимный наследник контроллера
        $controller =

            new class extends DefaultController {
            /**
             * Публичный доступ к withViewCache для теста
             *
             * @return static
             */
            public function callWithViewCache(): static
            {
                return $this->withViewCache(60);
            }


            /**
             * Публичный доступ к withViewLog для теста
             *
             * @return static
             */
            public function callWithViewLog(): static
            {
                return $this->withViewLog();
            }


            };

        $result = $controller->callWithViewCache();
        $this->assertInstanceOf(DefaultController::class, $result);

        $result = $controller->callWithViewLog();
        $this->assertInstanceOf(DefaultController::class, $result);
    }
}
