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
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        HttpLog::query()->truncate();
    }


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

        $count = HttpLog::query()->where('type', HttpLogTypeEnum::In)->count();
        $this->assertSame(1, $count);
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

        $count = HttpLog::query()->where('type', HttpLogTypeEnum::Out)->count();
        $this->assertSame(1, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\HttpLogTestController::testHttpLogInWithCache()
     *
     * @return void
     */
    #[Test]
    public function testHttpLogInWithCache(): void
    {
        $response = $this->call('POST', '/api/testing/testHttpLogInWithCache');
        $result1 = $response->getContent();

        $response = $this->call('POST', '/api/testing/testHttpLogInWithCache');
        $result2 = $response->getContent();

        $this->assertSame($result1, $result2);

        $count = HttpLog::query()
            ->where('type', HttpLogTypeEnum::In)
            ->where('is_cached', true)
            ->count();
        $this->assertSame(2, $count);

        $count = HttpLog::query()
            ->where('type', HttpLogTypeEnum::In)
            ->where('is_from_cache', true)
            ->count();
        $this->assertSame(1, $count);
    }


    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\HttpLogTestController::testHttpLogOutWithCache()
     *
     * @return void
     */
    #[Test]
    public function testHttpLogOutWithCache(): void
    {
        $response = $this->call('POST', '/api/testing/testHttpLogOutWithCache');
        $result1 = $response->getContent();

        sleep(1);

        $response = $this->call('POST', '/api/testing/testHttpLogOutWithCache');
        $result2 = $response->getContent();

        $this->assertSame($result1, $result2);

        $count = HttpLog::query()
            ->where('type', HttpLogTypeEnum::Out)
            ->where('is_cached', true)
            ->count();
        $this->assertGreaterThan(0, $count);

        $count = HttpLog::query()
            ->where('type', HttpLogTypeEnum::Out)
            ->where('is_from_cache', true)
            ->count();
        $this->assertSame(1, $count);
    }
}
