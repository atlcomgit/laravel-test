<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TestDto;
use App\Models\User;
use Atlcom\Helper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        // $a = DB::select('select * from users');
        // $a = DB::table('users')->first();
        // dd($a);

        // $user = User::create(['name' => 'asdasd', 'email' => 'sdf', 'password' => '234']);
        $user = User::query()->withCache()->first();
        // dd($user);
        $user->name = Helper::fakeName();
        $user->save();

        return response()->json(['user_id' => $dto->user_id]);
    }
}
