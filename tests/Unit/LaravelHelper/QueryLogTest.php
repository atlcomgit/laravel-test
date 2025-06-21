<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ModelLogTypeEnum;
use Atlcom\LaravelHelper\Models\ModelLog;
use PHPUnit\Framework\Attributes\Test;

//?!? 
class QueryLogTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testQueryLog()
     *
     * @return void
     */
    #[Test]
    public function testQueryLog(): void
    {
        $this->call('POST', '/api/testing/testQueryLog')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Create)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }
}