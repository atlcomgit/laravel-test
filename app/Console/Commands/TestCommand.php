<?php

namespace App\Console\Commands;

use Atlcom\LaravelHelper\Defaults\DefaultCommand;
use Illuminate\Support\Str;

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
        $a = Str::intervalBetween(2, 1, 2, 3);
        dd($a);
    }
}
