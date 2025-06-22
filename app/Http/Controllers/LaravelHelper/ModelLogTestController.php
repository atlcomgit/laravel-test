<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use App\Models\Test;
use Atlcom\Helper;
use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ModelLogTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testModelLogEloquentCreate(): Response
    {
        $result = Test::withModelLog()->create(['name' => $name = Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testModelLogEloquentInsert(): Response
    {
        $result = Test::withModelLog()->insert(['name' => $name = Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testModelLogEloquentUpdate(): Response
    {
        $result = Test::withModelLog()->update(['name' => $name = Helper::fakeName()]);

        return $this->response((bool)$result);
    }


    public function testModelLogEloquentDelete(): Response
    {
        $result = Test::withModelLog()->delete();

        return $this->response((bool)$result);
    }


    public function testModelLogEloquentForceDelete(): Response
    {
        $result = Test::withModelLog()->forceDelete();

        return $this->response((bool)$result);
    }


    public function testModelLogEloquentTruncate(): Response
    {
        Test::withModelLog()->truncate();

        Test::factory(2)->create();
        Test::query()->withModelLog()->truncate();

        return $this->response(true);
    }


    public function testModelLogDatabaseInsert(): Response
    {
        DB::table('tests')->withModelLog()->insert(['name' => Helper::fakeName()]);
        DB::query()->from('tests')->withModelLog()->insert(['name' => Helper::fakeName()]);

        return $this->response(true);
    }


    public function testModelLogDatabaseUpdate(): Response
    {
        DB::table('tests')->withModelLog()->whereNotNull('name')->update(['name' => Helper::fakeName()]);
        DB::query()->from('tests')->withModelLog()->update(['name' => Helper::fakeName()]);

        return $this->response(true);
    }


    public function testModelLogDatabaseDelete(): Response
    {
        DB::table('tests')->withModelLog()->delete();

        Test::factory(2)->create();
        DB::query()->from('tests')->withModelLog()->delete();

        return $this->response(true);
    }


    public function testModelLogDatabaseTruncate(): Response
    {
        DB::table('tests')->withModelLog()->truncate();
        DB::query()->from('tests')->withModelLog()->truncate();

        return $this->response(true);
    }
}
