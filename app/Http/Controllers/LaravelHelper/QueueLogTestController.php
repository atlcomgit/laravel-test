<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use App\Jobs\TestJob;
use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;

class QueueLogTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testQueueLogWithoutLog(): Response
    {
        TestJob::dispatchSync();

        return $this->response(true);
    }


    public function testQueueLogWithLog(): Response
    {
        dispatch_sync(new TestJob()->withQueueLog());

        return $this->response(true);
    }
}
