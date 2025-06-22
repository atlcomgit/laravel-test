<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use App\Console\Commands\TestCommand;
use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class ConsoleLogTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testConsoleLog(): Response
    {
        Artisan::call(TestCommand::class, ['--log' => true]);

        return $this->response(true);
    }
}
