<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TestDto;
use App\Models\Test;
use Atlcom\LaravelHelper\Defaults\DefaultController;

class TestController extends DefaultController
{
    /**
     * Тестовый роут
     * @link http://laravel-test.local:8800/api/test
     *
     * @param TestDto $dto
     */
    public function test(TestDto $dto)
    {
        // return  User::create(['name' => 'asdasd', 'email' => 'sdf', 'password' => '234']);
        // return  User::query()->withQueryCache()->first();
        // $user = User::query()->withQueryCache()->count();
        // $user = User::query()->withQueryCache()->exists();
        // Log::info('name: ' . $user?->name);
        // Log::info('isFromCached: ' . (string)$user->isFromCached());
        // Log::info('isCached: ' . (string)$user->isCached());

        // $user->name = Helper::fakeName();
        // $user->save();
        // return $user;

        // return User::first()->fill(['name' => Helper::fakeName()])->withModelLog()->save();
        // return User::query()->withModelLog()->insert(['email' => Helper::fakeEmail(), 'password' => Helper::fakePassword(), 'name' => Helper::fakeName()]);
        // return User::query()->withModelLog()->where('id', 20)->update(['name1' => Helper::fakeName()]);
        // return User::query()->withModelLog()->where('id', User::orderByDesc('id')->first()?->id)->delete();

        // return response()->json(['user_id' => $dto->user_id]);

        // dispatch_sync((new TestJob())->withJobLog());
        // dispatch_sync(new TestJob());
        // return 'ok';

        // return $this->withViewCache()->withViewLog()->view('test', ['test' => '16']);
        // return $this->withViewLog()->view('test', ['test' => '16']);
        // return $this->withViewCache()->withViewLog()->view(view: 'test', data: ['test' => '18'], ignoreData: ['test']);

        // $test = Test::withModelLog()->withQueryLog()->create(['name' => $name = Helper::fakeName()]);
        // $test = Test::withModelLog()->withQueryLog()->insert(['name' => $name = Helper::fakeName()]);
        // $test = Test::withModelLog()->withQueryLog()->where('name', $name)->update(['name' => $name = Helper::fakeName()]);
        // $test = Test::withModelLog()->withQueryLog()->where('name', $name)->delete();

        $test = Test::withQueryCache()->withQueryLog()->first();
        $test = Test::withQueryCache()->withQueryLog()->first();

        // $test = Test::withQueryLog()->create(['name' => $name = Helper::fakeName()]);

        // $test->update(['name' => $name = Helper::fakeName()]);
        // $test->fill(['name' => $name = Helper::fakeName()])->save();
        // $test->delete();
        // $test->withQueryLog()->withModelLog()->forceDelete();

        // $test = Test::query()->withQueryLog()->withQueryCache()->orderByDesc('id')->withTrashed()->first();
        // $test->name = Helper::fakeName();
        // $test->save();
        // $test->delete();
        // $test->restore();

        // Test::withQueryLog()->withModelLog()->truncate();
        return $test;

        return 'ok';
    }
}
