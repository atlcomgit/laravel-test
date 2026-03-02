<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\DefaultResource;

use App\Models\Test as TestModel;
use Atlcom\LaravelHelper\Defaults\DefaultResource;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\Framework\Attributes\Test;

/**
 * Конкретный наследник DefaultResource для тестирования
 */
class TestResource extends DefaultResource
{
    /**
     * Преобразует ресурс в массив
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}

/**
 * Тесты класса DefaultResource
 */
class WhenFilledTest extends DefaultTest
{
    /**
     * Тест метода whenFilled с заполненным значением
     * @see \Atlcom\LaravelHelper\Defaults\DefaultResource::whenFilled()
     *
     * @return void
     */
    #[Test]
    public function whenFilledReturnsValueWhenFilled(): void
    {
        // Создаём модель для ресурса
        $model = TestModel::factory()->create();
        $resource = new TestResource($model);

        // Заполненное значение должно пройти
        $result = $resource->whenFilled('test_value');

        $this->assertNotNull($result);
    }


    /**
     * Тест метода getStructure / setStructure
     * @see \Atlcom\LaravelHelper\Defaults\DefaultResource::setStructure()
     * @see \Atlcom\LaravelHelper\Defaults\DefaultResource::getStructure()
     *
     * @return void
     */
    #[Test]
    public function structureGetterAndSetter(): void
    {
        $model = TestModel::factory()->create();
        $resource = new TestResource($model);

        // Устанавливаем структуру
        $returnedResource = $resource->setStructure('test_structure');

        // Проверяем что возвращает себя (fluent)
        $this->assertInstanceOf(DefaultResource::class, $returnedResource);
        $this->assertSame('test_structure', $resource->getStructure());
    }


    /**
     * Тест что ресурс корректно создаётся из модели
     * @see \Atlcom\LaravelHelper\Defaults\DefaultResource
     *
     * @return void
     */
    #[Test]
    public function resourceCreationFromModel(): void
    {
        $model = TestModel::factory()->create(['name' => 'Тестовая запись']);
        $resource = new TestResource($model);

        $response = $resource->toResponse(request());

        $this->assertNotNull($response);
    }
}
