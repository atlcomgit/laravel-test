<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\IpBlockService;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Services\IpBlockService;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты метода resolveClientIp сервиса IpBlockService
 */
class ResolveClientIpTest extends DefaultTest
{
    private IpBlockService $service;


    protected function setUp(): void
    {
        parent::setUp();

        // Включаем IpBlock для тестов
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.enabled', true);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.trusted_proxies', [
            '172.18.0.0/16',
            '10.0.0.0/8',
            '127.0.0.1',
        ]);

        $this->service = app(IpBlockService::class);
    }


    /**
     * Тест получения IP из REMOTE_ADDR при отсутствии прокси-заголовков
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::resolveClientIp()
     *
     * @return void
     */
    #[Test]
    public function resolveClientIpFromRemoteAddr(): void
    {
        // Клиент подключается напрямую (не через trusted proxy)
        $request = Request::create('/', 'GET', [], [], [], [
            'REMOTE_ADDR' => '203.0.113.50',
        ]);

        $ip = $this->service->resolveClientIp($request);

        $this->assertEquals('203.0.113.50', $ip);
    }


    /**
     * Тест получения реального IP из X-Forwarded-For через trusted proxy (Docker)
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::resolveClientIp()
     *
     * @return void
     */
    #[Test]
    public function resolveClientIpFromXForwardedForDocker(): void
    {
        // Docker: REMOTE_ADDR = контейнер nginx (172.18.0.x)
        // X-Forwarded-For: клиент, промежуточный прокси
        $request = Request::create('/', 'GET', [], [], [], [
            'REMOTE_ADDR'          => '172.18.0.5',
            'HTTP_X_FORWARDED_FOR' => '203.0.113.50, 172.18.0.3',
        ]);

        $ip = $this->service->resolveClientIp($request);

        // Должен вернуть клиентский IP (самый правый нетрастед)
        $this->assertEquals('203.0.113.50', $ip);
    }


    /**
     * Тест защиты от спуфинга X-Forwarded-For
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::resolveClientIp()
     *
     * @return void
     */
    #[Test]
    public function resolveClientIpIgnoresSpoofedLeftmostIp(): void
    {
        // Клиент пытается подделать IP через X-Forwarded-For
        // Реальная цепочка: spoofed, real_client, proxy
        $request = Request::create('/', 'GET', [], [], [], [
            'REMOTE_ADDR'          => '172.18.0.5',
            'HTTP_X_FORWARDED_FOR' => '1.2.3.4, 203.0.113.50, 172.18.0.3',
        ]);

        $ip = $this->service->resolveClientIp($request);

        // Берём правый не-trusted IP — 203.0.113.50, а не подделанный 1.2.3.4
        $this->assertEquals('203.0.113.50', $ip);
    }


    /**
     * Тест фолбэка на X-Real-IP при пустом X-Forwarded-For
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::resolveClientIp()
     *
     * @return void
     */
    #[Test]
    public function resolveClientIpFallbackToXRealIp(): void
    {
        $request = Request::create('/', 'GET', [], [], [], [
            'REMOTE_ADDR'    => '172.18.0.5',
            'HTTP_X_REAL_IP' => '198.51.100.10',
        ]);

        $ip = $this->service->resolveClientIp($request);

        $this->assertEquals('198.51.100.10', $ip);
    }


    /**
     * Тест возврата REMOTE_ADDR если REMOTE_ADDR не доверенный прокси
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::resolveClientIp()
     *
     * @return void
     */
    #[Test]
    public function resolveClientIpReturnRemoteAddrWhenNotTrusted(): void
    {
        // REMOTE_ADDR не в trusted_proxies — игнорируем X-Forwarded-For
        $request = Request::create('/', 'GET', [], [], [], [
            'REMOTE_ADDR'          => '203.0.113.99',
            'HTTP_X_FORWARDED_FOR' => '1.2.3.4',
        ]);

        $ip = $this->service->resolveClientIp($request);

        $this->assertEquals('203.0.113.99', $ip);
    }


    /**
     * Тест обработки невалидных IP в X-Forwarded-For
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::resolveClientIp()
     *
     * @return void
     */
    #[Test]
    public function resolveClientIpSkipsInvalidIps(): void
    {
        $request = Request::create('/', 'GET', [], [], [], [
            'REMOTE_ADDR'          => '172.18.0.5',
            'HTTP_X_FORWARDED_FOR' => 'invalid, , 203.0.113.50',
        ]);

        $ip = $this->service->resolveClientIp($request);

        $this->assertEquals('203.0.113.50', $ip);
    }
}
