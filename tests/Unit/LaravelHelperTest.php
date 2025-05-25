<?php

declare(strict_types=1);

namespace Tests\Unit;

use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LaravelHelperTest extends TestCase
{
    #[Test]
    public function strIntervalBetween(): void
    {
        $this->assertSame([2], Str::intervalBetween(2, 1, 2, 3));
    }
}