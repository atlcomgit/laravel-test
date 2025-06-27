<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use App\Models\Test;
use Atlcom\Helper;
use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class QueryCacheTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testQueryCacheDbSelectWithoutLog(): Response
    {
        $result = DB::withQueryLog()->select('select * from tests');

        return $this->response((bool)$result);
    }


    public function testQueryCacheDbSelectWithLog(): Response
    {
        $result = DB::withQueryCache()->withQueryLog()->select('select * from tests');
        $result = DB::withQueryCache()->withQueryLog()->select('select * from tests');
        $result = DB::query()->withQueryCache()->withQueryLog()->select(['*'])->from('tests')->get();
        $result = DB::query()->withQueryCache()->withQueryLog()->select(['*'])->from('tests')->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheDbStatementWithoutLog(): Response
    {
        $result = DB::select('select * from tests');

        return $this->response((bool)$result);
    }


    public function testQueryCacheDbStatementWithLog(): Response
    {
        $result = DB::withQueryCache()->withQueryLog()->statement('select * from tests order by id limit 1');
        $result = DB::withQueryCache()->withQueryLog()->statement('select * from tests order by id limit 1');

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseGetWithoutLog(): Response
    {
        $result = DB::table('tests')->orderByDesc('id')->first();

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseGetWithLog(): Response
    {
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->orderByDesc('id')->first();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->orderByDesc('id')->first();
        $result = DB::query()->withQueryCache()->withQueryLog()->from('tests')->orderByDesc('id')->first();
        $result = DB::query()->withQueryCache()->withQueryLog()->from('tests')->orderByDesc('id')->first();

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseUpdateWithoutLog(): Response
    {
        $result = DB::table('tests')->update(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseUpdateWithLog(): Response
    {
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->update(['name' => Helper::fakeName()]);

        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::query()->withQueryCache()->withQueryLog()->from('tests')->update(['name' => Helper::fakeName()]);

        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseDeleteWithoutLog(): Response
    {
        $result = DB::table('tests')->delete();

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseDeleteWithLog(): Response
    {
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->delete();

        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();

        Test::factory()->create();
        $result = DB::query()->withQueryCache()->withQueryLog()->from('tests')->delete();

        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseInsertWithoutLog(): Response
    {
        $result = DB::table('tests')->insert(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryCacheDatabaseInsertWithLog(): Response
    {
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->insert(['name' => Helper::fakeName()]);

        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::query()->withQueryCache()->withQueryLog()->from('tests')->insert(['name' => Helper::fakeName()]);

        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();
        $result = DB::table('tests')->withQueryCache()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderFindWithoutLog(): Response
    {
        $test = Test::first();
        $result = Test::query()->find($test->id);

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderFindWithLog(): Response
    {
        $test = Test::withQueryCache()->withQueryLog()->first();
        $test = Test::withQueryCache()->withQueryLog()->first();
        $result = Test::withQueryCache()->withQueryLog()->find($test->id);

        $test = Test::withQueryCache()->withQueryLog()->first();
        $result = Test::query()->withQueryCache()->withQueryLog()->find($test->id);

        $test = Test::withQueryCache()->withQueryLog()->first();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderFirstWithoutLog(): Response
    {
        $result = Test::query()->first();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderFirstWithLog(): Response
    {
        $result = Test::withQueryCache()->withQueryLog()->first();
        $result = Test::withQueryCache()->withQueryLog()->first();

        $result = Test::query()->withQueryCache()->withQueryLog()->first();
        $result = Test::query()->withQueryCache()->withQueryLog()->first();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderGetWithoutLog(): Response
    {
        $result = Test::query()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderGetWithLog(): Response
    {
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        
        $result = Test::query()->withQueryCache()->withQueryLog()->get();
        $result = Test::query()->withQueryCache()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderCreateWithoutLog(): Response
    {
        $result = Test::create(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderCreateWithLog(): Response
    {
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->create(['name' => Helper::fakeName()]);

        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::query()->withQueryCache()->withQueryLog()->create(['name' => Helper::fakeName()]);

        $result = Test::withQueryCache()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderUpdateWithoutLog(): Response
    {
        $result = Test::create(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderUpdateWithLog(): Response
    {
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->update(['name' => Helper::fakeName()]);

        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::query()->withQueryCache()->withQueryLog()->update(['name' => Helper::fakeName()]);

        $result = Test::withQueryCache()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderDeleteWithoutLog(): Response
    {
        $result = Test::query()->delete();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderDeleteWithLog(): Response
    {
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->delete();

        $result = Test::withQueryCache()->withQueryLog()->get();
        Test::factory()->create();

        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::query()->withQueryCache()->withQueryLog()->delete();

        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryCacheEloquentBuilderTruncateWithoutLog(): Response
    {
        Test::query()->truncate();

        return $this->response(true);
    }


    public function testQueryCacheEloquentBuilderTruncateWithLog(): Response
    {
        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        Test::withQueryCache()->withQueryLog()->truncate();

        $result = Test::withQueryCache()->withQueryLog()->get();
        Test::factory()->create();

        $result = Test::withQueryCache()->withQueryLog()->get();
        $result = Test::withQueryCache()->withQueryLog()->get();
        Test::query()->withQueryCache()->withQueryLog()->truncate();

        $result = Test::withQueryCache()->withQueryLog()->get();

        return $this->response(true);
    }
}
