<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\IpBlockService;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Services\IpBlockService;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты метода unblockIp сервиса IpBlockService
 */
class UnblockIpTest extends DefaultTest
{
    private IpBlockService $service;


    protected function setUp(): void
    {
        parent::setUp();

        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.enabled', true);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_allow', []);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.block_ttl_seconds', 3600);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.storage_file', storage_path('framework/testing-ip-block-state.php'));

        $this->service = new IpBlockService();
    }


    protected function tearDown(): void
    {
        $file = storage_path('framework/testing-ip-block-state.php');
        file_exists($file) && unlink($file);

        parent::tearDown();
    }


    /**
     * Тест разблокировки IP
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::unblockIp()
     *
     * @return void
     */
    #[Test]
    public function unblockIpRemovesFromBlockedList(): void
    {
        $this->service->blockIp('203.0.113.50', 'test', 'test', '');

        $this->assertTrue($this->service->isBlockedIp('203.0.113.50'));

        $result = $this->service->unblockIp('203.0.113.50');

        $this->assertTrue($result);
        $this->assertFalse($this->service->isBlockedIp('203.0.113.50'));
    }


    /**
     * Тест разблокировки несуществующего IP возвращает false
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::unblockIp()
     *
     * @return void
     */
    #[Test]
    public function unblockIpReturnsFalseForNonBlocked(): void
    {
        $result = $this->service->unblockIp('203.0.113.99');

        $this->assertFalse($result);
    }
}
