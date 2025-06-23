<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\ViewLog;
use Atlcom\LaravelHelper\Services\ViewCacheService;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;

class ViewCacheTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        ViewLog::query()->truncate();
        app(ViewCacheService::class)->flushViewCacheAll();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ViewCacheTestController::testViewCacheWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testViewCacheWithoutLog(): void
    {
        $this->call('POST', '/api/testing/testViewCacheWithoutLog')
            ->assertSuccessful();

        $count = ViewLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ViewCacheTestController::testViewCacheWithLog()
     *
     * @return void
     */
    #[Test]
    public function testViewCacheWithLog(): void
    {
        $this->call('POST', '/api/testing/testViewCacheWithLog')
            ->assertSuccessful();

        $count = ViewLog::query()->where('is_cached', true)->count();
        $this->assertSame(3, $count);

        $count = ViewLog::query()->where('is_from_cache', true)->count();
        $this->assertSame(3, $count);
    }
}
