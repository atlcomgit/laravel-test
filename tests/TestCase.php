<?php

namespace Tests;

use Atlcom\LaravelHelper\Traits\TestingTrait;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use TestingTrait;
}
