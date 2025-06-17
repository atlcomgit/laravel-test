<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\TestDto;
use App\Jobs\TestJob;
use App\Models\Test;
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
     */
    public function test(TestDto $dto)
    {
        // $a = DB::select('select * from users');
        // error $user = DB::query()->select('select * from users order by id limit 1')->get();
        // $user = DB::withQueryCache()->withQueryLog()->select('select * from users order by id limit 1');

        // кеш не используется для statement
        // $user = DB::withQueryCache()->withQueryLog()->statement('select * from users order by id limit 1');

        // $user = DB::table('users')->withQueryCache()->withQueryLog()->orderByDesc('id')->first();
        // DB::table('users')->withQueryCache()->withQueryLog()->update(['name' => Helper::fakeName()]);
        // return $user;

        // DB::table('users')->withQueryCache()->withQueryLog()->update(['name' => Helper::fakeName()]);
        // DB::from('users')->withQueryCache()->withQueryLog()->update(['name' => Helper::fakeName()]);
        // return DB::table('users')->withQueryLog()->insert([
        //     'email' => Helper::fakeEmail(),
        //     'password' => Helper::fakePassword(),
        //     'name' => Helper::fakeName(),
        // ]);

        // dd($user);
        // Log::info('name: ' . $user?->name);

        // Log::info('isFromCached: ' . (string)$user->isFromCached());
        // Log::info('isCached: ' . (string)$user->isCached());
        // dd($a);

        // return  User::withQueryCache()->withQueryLog()->find(20);
        // return  User::withQueryCache()->withQueryLog()->first();
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

        // Test::withModelLog()->withQueryLog()->insert(['name' => $name = Helper::fakeName()]);
        // Test::withModelLog()->withQueryLog()->where('name', $name)->update(['name' => $name = Helper::fakeName()]);
        // Test::withModelLog()->withQueryLog()->where('name', $name)->delete();

        // $test = Test::withQueryCache()->withQueryLog()->first();
        // $test = Test::withQueryLog()->create(['name' => $name = Helper::fakeName()]);

        // $test->update(['name' => $name = Helper::fakeName()]);
        // $test->fill(['name' => $name = Helper::fakeName()])->save();
        // $test->delete();
        // $test->withQueryLog()->withModelLog()->forceDelete();

        $test = Test::query()->withQueryLog()->withQueryCache()->orderByDesc('id')->withTrashed()->first();
        // $test->name = Helper::fakeName();
        // $test->save();
        // $test->delete();
        // $test->restore();

        // Test::withQueryLog()->withModelLog()->truncate();

        return 'ok';
    }
}
