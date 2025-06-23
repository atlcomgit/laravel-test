<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\ViewLog;
use PHPUnit\Framework\Attributes\Test;

class ViewLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        ViewLog::query()->truncate();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ViewLogTestController::testViewLogWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testViewLogWithoutLog(): void
    {
        $this->call('POST', '/api/testing/testViewLogWithoutLog')
            ->assertSuccessful();

        $count = ViewLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ViewLogTestController::testViewLogWithLog()
     *
     * @return void
     */
    #[Test]
    public function testViewLogWithLog(): void
    {
        $this->call('POST', '/api/testing/testViewLogWithLog')
            ->assertSuccessful();

        $count = ViewLog::query()->count();
        $this->assertSame(1, $count);
    }
}
