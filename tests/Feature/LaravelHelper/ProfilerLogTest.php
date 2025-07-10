<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\ProfilerLog;
use PHPUnit\Framework\Attributes\Test;

class ProfilerLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        ProfilerLog::query()->truncate();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ProfilerLogTestController::testProfilerLog()
     *
     * @return void
     */
    #[Test]
    public function testProfilerLog(): void
    {
        $this->call('POST', '/api/testing/testProfilerLog')
            ->assertSuccessful();

        $count = ProfilerLog::query()->count();
        $this->assertSame(1, $count);
    }
}
