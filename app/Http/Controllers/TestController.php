<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TestDto;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class TestController
{
    /**
     * Тестовый роут
     * @link http://laravel-test.local:8800/api/test
     *
     * @param TestDto $dto
     * @return JsonResponse
     */
    public function test(TestDto $dto): JsonResponse
    {
        // $user = User::create(['name' => 'asdasd', 'email' => 'sdf', 'password' => '234']);
        $user = User::query()->first();
        $user->name = '333';
        $user->save();

        return response()->json(['user_id' => $dto->user_id]);
    }
}
