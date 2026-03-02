<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\IpBlockService;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Services\IpBlockService;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты метода blockIp сервиса IpBlockService
 */
class BlockIpTest extends DefaultTest
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
        $file = storage_path('framework/testing-ip-block-state.php');
        file_exists($file) && unlink($file);

        parent::tearDown();
    }


    /**
     * Тест блокировки IP и проверки через getBlockedIps
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::blockIp()
     *
     * @return void
     */
    #[Test]
    public function blockIpAddsToBlockedList(): void
    {
        $this->service->blockIp('203.0.113.50', 'test_rule', 'test', 'Тестовая блокировка');

        $blocked = $this->service->getBlockedIps();

        $this->assertNotEmpty($blocked);
        $this->assertEquals('203.0.113.50', $blocked[0]['ip']);
        $this->assertEquals('test_rule', $blocked[0]['reason']);
    }


    /**
     * Тест: повторная блокировка уже заблокированного IP не создаёт дубликатов
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::blockIp()
     *
     * @return void
     */
    #[Test]
    public function blockIpDoesNotDuplicateBlock(): void
    {
        $this->service->blockIp('203.0.113.50', 'rule1', 'test', '');
        $this->service->blockIp('203.0.113.50', 'rule2', 'test', '');

        $blocked = $this->service->getBlockedIps();

        // Должна остаться только одна запись
        $ips = array_column($blocked, 'ip');
        $count = array_count_values($ips)['203.0.113.50'] ?? 0;

        $this->assertEquals(1, $count);
    }


    /**
     * Тест: IP из allow-листа невозможно заблокировать
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::blockIp()
     *
     * @return void
     */
    #[Test]
    public function blockIpSkipsAllowListedIp(): void
    {
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_allow', [
            '203.0.113.50',
        ]);

        $service = new IpBlockService();
        $service->blockIp('203.0.113.50', 'test', 'test', '');

        $blocked = $service->getBlockedIps();

        $this->assertEmpty($blocked);
    }
}
