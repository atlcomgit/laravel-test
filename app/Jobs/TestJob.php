<?php

declare(strict_types=1);

namespace App\Jobs;

use Atlcom\LaravelHelper\Defaults\DefaultJob;

class TestJob extends DefaultJob
{
    // public bool $logEnabled = true;


    public function __invoke(): void {}
}
