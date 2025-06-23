<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\ConsoleLog;
use PHPUnit\Framework\Attributes\Test;

class ConsoleLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        ConsoleLog::query()->truncate();
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\ConsoleLogTestController::testConsoleLog()
     *
     * @return void
     */
    #[Test]
    public function testConsoleLog(): void
    {
        $this->call('POST', '/api/testing/testConsoleLog')
            ->assertSuccessful();

        $count = ConsoleLog::query()->where('name', 'TestCommand')->count();
        $this->assertSame(1, $count);
    }
}
