<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Enums\ModelLogTypeEnum;
use Atlcom\LaravelHelper\Models\ModelLog;
use PHPUnit\Framework\Attributes\Test;

//?!? 
class ViewCacheTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see ViewCacheTestController::testViewLog()
     *
     * @return void
     */
    #[Test]
    public function testViewLog(): void
    {
        $this->call('POST', '/api/testing/testViewLog')
            ->assertSuccessful();

        $model = ModelLog::query()
            ->ofModelType(\App\Models\Test::class)
            ->ofType(ModelLogTypeEnum::Create)
            ->first();
        $this->assertInstanceOf(ModelLog::class, $model);
    }
}