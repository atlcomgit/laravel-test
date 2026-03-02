<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\IpBlockMiddleware;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Middlewares\IpBlockMiddleware;
use Atlcom\LaravelHelper\Services\IpBlockService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты метода handle посредника IpBlockMiddleware
 */
class HandleTest extends DefaultTest
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.storage_file', storage_path('framework/testing-ip-block-state.php'));
    }


    protected function tearDown(): void
    {
        $file = storage_path('framework/testing-ip-block-state.php');
        file_exists($file) && unlink($file);

        parent::tearDown();
    }


    /**
     * Тест: при отключённом IpBlock запрос проходит насквозь
     * @see \Atlcom\LaravelHelper\Middlewares\IpBlockMiddleware::handle()
     *
     * @return void
     */
    #[Test]
    public function handlePassesThroughWhenDisabled(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.enabled', false);

        $middleware = new IpBlockMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->server->set('REMOTE_ADDR', '203.0.113.50');

        $response = $middleware->handle($request, fn ($req) => new Response('ok', 200));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('ok', $response->getContent());
    }


    /**
     * Тест: заблокированный IP получает 403
     * @see \Atlcom\LaravelHelper\Middlewares\IpBlockMiddleware::handle()
     *
     * @return void
     */
    #[Test]
    public function handleReturns403ForBlockedIp(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.enabled', true);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_allow', []);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_deny', []);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.block_ttl_seconds', 3600);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.response_status', 403);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.ignore', []);

        // Блокируем IP через сервис
        $service = new IpBlockService();
        $service->blockIp('203.0.113.50', 'test', 'test', '');

        // Подменяем singleton свежим экземпляром который окажет тот же state
        $this->app->instance(IpBlockService::class, $service);

        $middleware = new IpBlockMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->server->set('REMOTE_ADDR', '203.0.113.50');

        $response = $middleware->handle($request, fn ($req) => new Response('ok', 200));

        $this->assertEquals(403, $response->getStatusCode());
    }


    /**
     * Тест: IP из allow-листа всегда пропускается
     * @see \Atlcom\LaravelHelper\Middlewares\IpBlockMiddleware::handle()
     *
     * @return void
     */
    #[Test]
    public function handlePassesThroughForAllowListedIp(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.enabled', true);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_allow', ['203.0.113.50']);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_deny', []);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.ignore', []);

        $service = new IpBlockService();
        $this->app->instance(IpBlockService::class, $service);

        $middleware = new IpBlockMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->server->set('REMOTE_ADDR', '203.0.113.50');

        $response = $middleware->handle($request, fn ($req) => new Response('ok', 200));

        $this->assertEquals(200, $response->getStatusCode());
    }
}
