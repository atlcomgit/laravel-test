<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LaravelHelperTest extends TestCase
{
    /**
     * Тестирование Str макросов
     *
     * @return void
     */
    #[Test]
    public function strMacros(): void
    {
        $this->assertSame([2], Str::intervalBetween(2, 1, 2, 3));
    }


    /**
     * Тестирование api с dto
     * @see \App\Http\Controllers\TestController::test()
     *
     * @return void
     */
    #[Test]
    public function apiTest(): void
    {
        $this->call('GET', '/api/test', ['user_id' => 1])
            ->assertSuccessful()
            ->assertJsonFragment(['user_id' => 1]);
    }
}