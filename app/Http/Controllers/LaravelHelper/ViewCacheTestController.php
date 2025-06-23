<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;

class ViewCacheTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testViewCacheWithoutLog(): Response
    {
        $result = $this->view('test', ['test' => '1']);

        return $this->response((bool)$result);
    }


    public function testViewCacheWithLog(): Response
    {
        $result = $this->withViewCache()->withViewLog()->view('test', ['test' => '1']);
        $result = $this->withViewCache()->withViewLog()->view('test', ['test' => '1']);

        $result = $this->withViewCache()->withViewLog()->view('test', ['test' => '2']);
        $result = $this->withViewCache()->withViewLog()->view('test', ['test' => '2']);

        $result = $this->withViewCache()->withViewLog()->view('test', ['test' => '3'], [], ['test']);
        $result = $this->withViewCache()->withViewLog()->view('test', ['test' => '4'], [], ['test']);

        return $this->response((bool)$result);
    }
}
