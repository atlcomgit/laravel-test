<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\IpBlockService;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Services\IpBlockService;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты метода isBlockedIp сервиса IpBlockService
 */
class IsBlockedIpTest extends DefaultTest
{
    private IpBlockService $service;


    protected function setUp(): void
    {
        parent::setUp();

        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.enabled', true);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_allow', []);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_deny', []);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.block_ttl_seconds', 3600);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.storage_file', storage_path('framework/testing-ip-block-state.php'));

        $this->service = new IpBlockService();
    }


    protected function tearDown(): void
    {
        // Очистка тестового файла состояния
        $file = storage_path('framework/testing-ip-block-state.php');
        file_exists($file) && unlink($file);

        parent::tearDown();
    }


    /**
     * Тест: незаблокированный IP возвращает false
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::isBlockedIp()
     *
     * @return void
     */
    #[Test]
    public function isBlockedIpReturnsFalseForCleanIp(): void
    {
        $result = $this->service->isBlockedIp('203.0.113.50');

        $this->assertFalse($result);
    }


    /**
     * Тест: IP из deny-листа всегда заблокирован
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::isBlockedIp()
     *
     * @return void
     */
    #[Test]
    public function isBlockedIpReturnsTrueForDenyListIp(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_deny', [
            '198.51.100.0/24',
        ]);

        $service = new IpBlockService();
        $result = $service->isBlockedIp('198.51.100.50');

        $this->assertTrue($result);
    }


    /**
     * Тест: IP из allow-листа никогда не блокируется
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::isBlockedIp()
     *
     * @return void
     */
    #[Test]
    public function isBlockedIpReturnsFalseForAllowListIp(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_allow', [
            '203.0.113.50',
        ]);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_deny', [
            '203.0.113.50',
        ]);

        $service = new IpBlockService();

        // Allow-лист имеет приоритет над deny-листом
        $result = $service->isBlockedIp('203.0.113.50');

        $this->assertFalse($result);
    }


    /**
     * Тест: вручную заблокированный IP возвращает true
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::isBlockedIp()
     *
     * @return void
     */
    #[Test]
    public function isBlockedIpReturnsTrueForManuallyBlockedIp(): void
    {
        $this->service->blockIp('203.0.113.50', 'test', 'test', 'Тестовая блокировка');

        $result = $this->service->isBlockedIp('203.0.113.50');

        $this->assertTrue($result);
    }


    /**
     * Тест: пустой IP не считается заблокированным
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::isBlockedIp()
     *
     * @return void
     */
    #[Test]
    public function isBlockedIpReturnsFalseForEmptyIp(): void
    {
        $result = $this->service->isBlockedIp('');

        $this->assertFalse($result);
    }
}
