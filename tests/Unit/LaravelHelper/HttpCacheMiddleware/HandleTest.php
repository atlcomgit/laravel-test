<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\HttpCacheMiddleware;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Middlewares\HttpCacheMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты метода handle посредника HttpCacheMiddleware
 */
class HandleTest extends DefaultTest
{
    /**
     * Тест: при отключённом HttpCache запрос проходит насквозь
     * @see \Atlcom\LaravelHelper\Middlewares\HttpCacheMiddleware::handle()
     *
     * @return void
     */
    #[Test]
    public function handlePassesThroughWhenDisabled(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::HttpCache->value . '.enabled', false);

        $middleware = new HttpCacheMiddleware();
        $request = Request::create('/api/test', 'GET');

        $response = $middleware->handle($request, fn ($req) => new Response('original', 200));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('original', $response->getContent());
    }


    /**
     * Тест: при включённом HttpCache middleware обрабатывает запрос
     * @see \Atlcom\LaravelHelper\Middlewares\HttpCacheMiddleware::handle()
     *
     * @return void
     */
    #[Test]
    public function handleProcessesWhenEnabled(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::HttpCache->value . '.enabled', true);

        // Сбрасываем статические свойства
        HttpCacheMiddleware::$cacheEnabled = false;
        HttpCacheMiddleware::$cacheKey = null;
        HttpCacheMiddleware::$isCached = false;
        HttpCacheMiddleware::$isFromCache = false;

        $middleware = new HttpCacheMiddleware();
        $request = Request::create('/api/test', 'GET');

        $response = $middleware->handle($request, fn ($req) => new Response('fresh', 200));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('fresh', $response->getContent());
        $this->assertTrue(HttpCacheMiddleware::$cacheEnabled);
    }


    /**
     * Тест: статические свойства отражают состояние кеша
     * @see \Atlcom\LaravelHelper\Middlewares\HttpCacheMiddleware::handle()
     *
     * @return void
     */
    #[Test]
    public function handleStaticPropertiesReflectState(): void
    {
        // Сброс
        HttpCacheMiddleware::$cacheEnabled = false;
        HttpCacheMiddleware::$cacheKey = null;
        HttpCacheMiddleware::$isCached = false;
        HttpCacheMiddleware::$isFromCache = false;

        $this->assertFalse(HttpCacheMiddleware::$cacheEnabled);
        $this->assertNull(HttpCacheMiddleware::$cacheKey);
        $this->assertFalse(HttpCacheMiddleware::$isCached);
        $this->assertFalse(HttpCacheMiddleware::$isFromCache);
    }
}
