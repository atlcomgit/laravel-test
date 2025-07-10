<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultController;
use Atlcom\LaravelHelper\Traits\ProfilerLogTrait;
use Illuminate\Http\Response;

class ProfilerLogTestController extends DefaultController
{
    use ProfilerLogTrait;


    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testProfilerLog(): Response
    {
        $result = $this->_profiler(a: 2);
        $result = $this->_profiler(a: 20);

        return $this->response((bool)$result);
    }


    public function profiler($a)
    {
        return ['a' => $a + 1];
    }
}
