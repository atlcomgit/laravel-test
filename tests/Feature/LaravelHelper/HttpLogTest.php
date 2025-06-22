<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\HttpLogTypeEnum;
use Atlcom\LaravelHelper\Models\HttpLog;
use PHPUnit\Framework\Attributes\Test;

class HttpLogTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\HttpLogTestController::testHttpLogIn()
     *
     * @return void
     */
    #[Test]
    public function testHttpLogIn(): void
    {
        $this->call('POST', '/api/testing/testHttpLogIn')
            ->assertSuccessful();

        $model = HttpLog::query()->where('type', HttpLogTypeEnum::In)->first();
        $this->assertInstanceOf(HttpLog::class, $model);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\HttpLogTestController::testHttpLogOut()
     *
     * @return void
     */
    #[Test]
    public function testHttpLogOut(): void
    {
        $this->call('POST', '/api/testing/testHttpLogOut')
            ->assertSuccessful();

        $model = HttpLog::query()->where('type', HttpLogTypeEnum::Out)->first();
        $this->assertInstanceOf(HttpLog::class, $model);
    }
}
