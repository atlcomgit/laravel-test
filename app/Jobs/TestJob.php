<?php

declare(strict_types=1);

namespace App\Jobs;

use Atlcom\LaravelHelper\Defaults\DefaultJob;

class TestJob extends DefaultJob
{
    /** Флаг включения логирования очереди */
    // public bool $withJobLog = false;


    public function __invoke(): void {}
}
