<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;

class RouteLogTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testRouteLog(): Response
    {
        return $this->response(true);
    }
}