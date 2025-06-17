<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\User;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\ModelLog;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

class LaravelHelperTest extends DefaultTest
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


    /**
     * Тестирование api с dto
     * @see \App\Http\Controllers\TestController::test()
     *
     * @return void
     */
    #[Test]
    public function modelLogTest(): void
    {
        $user = User::factory()->create();

        $modelLog = ModelLog::queryFrom(
            config('laravel-helper.model_log.connection'),
            config('laravel-helper.model_log.table'),
        )
            ->ofModel($user)
            ->first();

        $this->assertNotNull($modelLog);
    }
}
