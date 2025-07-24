<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class HttpLogTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testHttpLogIn(): Response
    {
        return $this->response(true);
    }


    public function testHttpLogOut(): Response
    {
        /** @var \Illuminate\Http\Client\PendingRequest $http */
        $http = Http::localhost();
        $response = $http->post('/api/testing/testHttpLogIn');

        return $this->response($response->successful());
    }


    public function testHttpLogInWithCache(): Response
    {
        return response((string)rand(0, 999999999));
    }


    public function testHttpLogOutWithCache(): Response
    {
        /** @var \Illuminate\Http\Client\PendingRequest $http */
        $http = Http::withCache();
        // $response = $http->retry(5)->get('https://worldtimeapi.org/api/timezone/Etc/UTC');
        $response = $http->retry(5)->get('https://timeapi.io/api/Time/current/zone?timeZone=UTC');

        return response($response->getBody());
    }
}
