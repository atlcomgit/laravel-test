<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\IpBlockService;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ConfigEnum;
use Atlcom\LaravelHelper\Services\IpBlockService;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты метода cleanupExpired сервиса IpBlockService
 */
class CleanupExpiredTest extends DefaultTest
{
    private IpBlockService $service;


    protected function setUp(): void
    {
        parent::setUp();

        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.enabled', true);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.manual_allow', []);
        config()->set('laravel-helper.' . ConfigEnum::IpBlock->value . '.block_ttl_seconds', 60);
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
     * Тест очистки при отсутствии блокировок возвращает 0
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::cleanupExpired()
     *
     * @return void
     */
    #[Test]
    public function cleanupExpiredReturnsZeroWhenNoBlocks(): void
    {
        $result = $this->service->cleanupExpired();

        $this->assertEquals(0, $result);
    }


    /**
     * Тест очистки не удаляет активные блокировки
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::cleanupExpired()
     *
     * @return void
     */
    #[Test]
    public function cleanupExpiredKeepsActiveBlocks(): void
    {
        $this->service->blockIp('203.0.113.50', 'test', 'test', '');

        $result = $this->service->cleanupExpired();

        $this->assertEquals(0, $result);
        $this->assertNotEmpty($this->service->getBlockedIps());
    }


    /**
     * Тест: метод getRules возвращает структуру правил
     * @see \Atlcom\LaravelHelper\Services\IpBlockService::getRules()
     *
     * @return void
     */
    #[Test]
    public function cleanupExpiredGetRulesReturnsStructure(): void
    {
        $rules = $this->service->getRules();

        $this->assertArrayHasKey('enabled', $rules);
        $this->assertArrayHasKey('block_ttl_seconds', $rules);
        $this->assertArrayHasKey('rules', $rules);
        $this->assertIsArray($rules['rules']);
    }
}
