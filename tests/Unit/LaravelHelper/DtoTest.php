<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;

class DtoTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\TestController::testDependencyInjectionDto()
     *
     * @return void
     */
    #[Test]
    public function testDependencyInjectionDto(): void
    {
        $this->call('POST', '/api/testing/testDependencyInjectionDto', ['user_id' => 123])
            ->assertSuccessful();
    }
}