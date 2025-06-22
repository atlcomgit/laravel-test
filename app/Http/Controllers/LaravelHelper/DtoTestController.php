<?php

declare(strict_types=1);

namespace App\Http\Controllers\LaravelHelper;

use App\Dto\TestDto;
use Atlcom\LaravelHelper\Defaults\DefaultController;
use Illuminate\Http\Response;

class DtoTestController extends DefaultController
{
    private function response(bool $status): Response
    {
        return response(['status' => $status], $status ? 200 : 404);
    }


    public function testDependencyInjectionDto(TestDto $dto): Response
    {
        $result = $dto->user_id === 123;

        return $this->response($result);
    }
}
