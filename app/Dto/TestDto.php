<?php

declare(strict_types=1);

namespace App\Dto;

use Atlcom\LaravelHelper\Defaults\DefaultDto;

class TestDto extends DefaultDto
{
    public int $user_id;
}