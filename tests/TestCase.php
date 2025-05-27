<?php

namespace Tests;

use Atlcom\LaravelHelper\Traits\TestCaseTrait;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use TestCaseTrait;
}
