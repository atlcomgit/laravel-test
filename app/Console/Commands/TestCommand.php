<?php

namespace App\Console\Commands;

use Atlcom\LaravelHelper\Defaults\DefaultCommand;

class TestCommand extends DefaultCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        sleep(1);
    }
}
