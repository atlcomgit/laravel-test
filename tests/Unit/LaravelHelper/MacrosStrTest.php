<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

class MacrosStrTest extends DefaultTest
{
    /**
     * Тестирование Str макросов
     *
     * @return void
     */
    #[Test]
    public function strMacros(): void
    {
        $this->assertSame([2], Str::intervalBetween(2, 1, 2, 3));
    }
}