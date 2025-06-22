<?php

declare(strict_types=1);

namespace Tests\Feature\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;

class DtoTest extends DefaultTest
{
    /**
     * Тестирование метода контроллера
     * @see \App\Http\Controllers\LaravelHelper\DtoTestController::testDependencyInjectionDto()
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
