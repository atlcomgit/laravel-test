<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TestDto;
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
        return response()->json(['user_id' => $dto->user_id]);
    }
}
