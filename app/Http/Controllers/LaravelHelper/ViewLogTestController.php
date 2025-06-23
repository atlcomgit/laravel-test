<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;

class ViewLogTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testViewLogWithoutLog(): Response
    {
        $result = $this->view('test', ['test' => '1']);

        return $this->response((bool)$result);
    }


    public function testViewLogWithLog(): Response
    {
        $result = $this->withViewLog()->view('test', ['test' => '1']);

        return $this->response((bool)$result);
    }
}
