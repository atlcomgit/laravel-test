<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\ConsoleLog;
use PHPUnit\Framework\Attributes\Test;

class ConsoleLogTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testConsoleLog()
     *
     * @return void
     */
    #[Test]
    public function testConsoleLog(): void
    {
        $this->call('POST', '/api/testing/testConsoleLog')
            ->assertSuccessful();

        $model = ConsoleLog::query()->where('name', 'TestCommand')->first();
        $this->assertInstanceOf(ConsoleLog::class, $model);
    }
}