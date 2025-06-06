<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TestDto;
use App\Models\User;
use Atlcom\Helper;
use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TestController extends DefaultController
{
    /**
     * Тестовый роут
     * @link http://laravel-test.local:8800/api/test
     *
     * @param TestDto $dto
     * @return string|View|JsonResponse
     */
    public function test(TestDto $dto): string|View|JsonResponse
    {
        // $a = DB::select('select * from users');
        // $user = DB::query()->select('select * from users order by id limit 1')->get();
        // $user = DB::withCache()->select('select * from users order by id limit 1');

        // $user = DB::withCache()->statement('select * from users order by id limit 1');
        // $user = DB::table('users')->withCache()->first();
        // DB::table('users')->update(['name' => Helper::fakeName()]);
        // dd($user);
        // Log::info('name: ' . $user?->name);

        // Log::info('isFromCached: ' . (string)$user->isFromCached());
        // Log::info('isCached: ' . (string)$user->isCached());
        // dd($a);

        // $user = User::withCache()->first();
        // $user = User::create(['name' => 'asdasd', 'email' => 'sdf', 'password' => '234']);
        // $user = User::query()->withCache()->first();
        // $user = User::query()->withCache()->count();
        // $user = User::query()->withCache()->exists();
        // Log::info('name: ' . $user?->name);
        // Log::info('isFromCached: ' . (string)$user->isFromCached());
        // Log::info('isCached: ' . (string)$user->isCached());

        // $user->name = Helper::fakeName();
        // $user->save();

        // return response()->json(['user_id' => $dto->user_id]);

        // return $this->withCache()->view('test', ['test' => '16']);
        // return $this->withCache()->view(view: 'test', data: ['test' => '17'], ignoreData: ['test']);

        return '';
    }
}
