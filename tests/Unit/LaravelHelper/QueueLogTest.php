<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ModelLogTypeEnum;
use Atlcom\LaravelHelper\Models\ModelLog;
use PHPUnit\Framework\Attributes\Test;

//?!? 
class QueueLogTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testQueueLog()
     *
     * @return void
     */
    #[Test]
    public function testQueueLog(): void
    {
        $this->call('POST', '/api/testing/testQueueLog')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Create)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }
}