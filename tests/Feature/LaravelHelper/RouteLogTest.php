<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\RouteLog;
use Atlcom\LaravelHelper\Services\RouteLogService;
use PHPUnit\Framework\Attributes\Test;

class RouteLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        RouteLog::query()->truncate();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\RouteLogTestController::testRouteLog()
     *
     * @return void
     */
    #[Test]
    public function testRouteLog(): void
    {
        app(RouteLogService::class)->cleanup();

        $this->call('POST', '/api/testing/testRouteLog')
            ->assertSuccessful();

        $count = RouteLog::query()->where('count', '>', 0)->count();
        $this->assertSame(1, $count);
    }
}
