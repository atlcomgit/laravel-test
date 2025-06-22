<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use App\Models\Test;
use Atlcom\Helper;
use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class QueryLogTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testQueryLogDbSelectWithoutLog(): Response
    {
        $result = DB::select('select * from tests');

        return $this->response((bool)$result);
    }


    public function testQueryLogDbSelectWithLog(): Response
    {
        $result = DB::withQueryLog()->select('select * from tests');
        $result = DB::query()->withQueryLog()->select(['id'])->from('tests')->get();

        return $this->response((bool)$result);
    }


    public function testQueryLogDbStatementWithoutLog(): Response
    {
        $result = DB::select('select * from tests');

        return $this->response((bool)$result);
    }


    public function testQueryLogDbStatementWithLog(): Response
    {
        $result = DB::withQueryLog()->statement('select * from tests order by id limit 1');

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseGetWithoutLog(): Response
    {
        $result = DB::table('tests')->orderByDesc('id')->first();

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseGetWithLog(): Response
    {
        $result = DB::table('tests')->withQueryLog()->orderByDesc('id')->first();
        $result = DB::query()->withQueryLog()->from('tests')->orderByDesc('id')->first();

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseUpdateWithoutLog(): Response
    {
        $result = DB::table('tests')->update(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseUpdateWithLog(): Response
    {
        $result = DB::table('tests')->withQueryLog()->update(['name' => Helper::fakeName()]);
        $result = DB::query()->withQueryLog()->from('tests')->update(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseDeleteWithoutLog(): Response
    {
        $result = DB::table('tests')->delete();

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseDeleteWithLog(): Response
    {
        $result = DB::table('tests')->withQueryLog()->delete();

        Test::factory()->create();
        $result = DB::query()->withQueryLog()->from('tests')->delete();

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseInsertWithoutLog(): Response
    {
        $result = DB::table('tests')->insert(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogDatabaseInsertWithLog(): Response
    {
        $result = DB::table('tests')->withQueryLog()->insert(['name' => Helper::fakeName()]);
        $result = DB::query()->withQueryLog()->from('tests')->insert(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderFindWithoutLog(): Response
    {
        $test = Test::first();
        $result = Test::query()->find($test->id);

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderFindWithLog(): Response
    {
        $test = Test::first();
        $result = Test::withQueryLog()->find($test->id);
        $result = Test::query()->withQueryLog()->find($test->id);

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderFirstWithoutLog(): Response
    {
        $result = Test::query()->first();

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderFirstWithLog(): Response
    {
        $result = Test::withQueryLog()->first();
        $result = Test::query()->withQueryLog()->first();

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderGetWithoutLog(): Response
    {
        $result = Test::query()->get();

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderGetWithLog(): Response
    {
        $result = Test::withQueryLog()->get();
        $result = Test::query()->withQueryLog()->get();

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderCreateWithoutLog(): Response
    {
        $result = Test::create(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderCreateWithLog(): Response
    {
        $result = Test::withQueryLog()->create(['name' => Helper::fakeName()]);
        $result = Test::query()->withQueryLog()->create(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderUpdateWithoutLog(): Response
    {
        $result = Test::create(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderUpdateWithLog(): Response
    {
        $result = Test::withQueryLog()->update(['name' => Helper::fakeName()]);
        $result = Test::query()->withQueryLog()->update(['name' => Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderDeleteWithoutLog(): Response
    {
        $result = Test::query()->delete();

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderDeleteWithLog(): Response
    {
        $result = Test::withQueryLog()->delete();

        Test::factory()->create();
        $result = Test::query()->withQueryLog()->delete();

        return $this->response((bool)$result);
    }


    public function testQueryLogEloquentBuilderTruncateWithoutLog(): Response
    {
        Test::query()->truncate();

        return $this->response(true);
    }


    public function testQueryLogEloquentBuilderTruncateWithLog(): Response
    {
        Test::withQueryLog()->truncate();

        Test::factory()->create();
        Test::query()->withQueryLog()->truncate();

        return $this->response(true);
    }
}
