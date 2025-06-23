<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\QueueLog;
use PHPUnit\Framework\Attributes\Test;

class QueueLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        QueueLog::query()->truncate();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueueLogTestController::testQueueLogWithoutLog()
     *
     * @return void
     */
    #[Test]
    public function testQueueLogWithoutLog(): void
    {
        $this->call('POST', '/api/testing/testQueueLogWithoutLog')
            ->assertSuccessful();

        $count = QueueLog::query()->count();
        $this->assertSame(0, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\QueueLogTestController::testQueueLogWithLog()
     *
     * @return void
     */
    #[Test]
    public function testQueueLogWithLog(): void
    {
        $this->call('POST', '/api/testing/testQueueLogWithLog')
            ->assertSuccessful();

        $count = QueueLog::query()->count();
        $this->assertSame(1, $count);
    }
}
