<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\DefaultDto;

use App\Dto\TestDto;
use App\Models\User;
use Atlcom\LaravelHelper\Defaults\DefaultDto;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;

/**
 * Локальный DTO для тестирования fillFromModel с совместимыми полями
 */
class FillFromModelTestDto extends DefaultDto
{
    /** Имя (совпадает с атрибутом модели Test) */
    public ?string $name = null;
}

/**
 * Тесты метода fillFromModel класса DefaultDto
 */
class FillFromModelTest extends DefaultTest
{
    /**
     * Тест заполнения DTO из модели с совпадающим ключом
     * @see \Atlcom\LaravelHelper\Defaults\DefaultDto::fillFromModel()
     *
     * @return void
     */
    #[Test]
    public function fillFromModelFillsDtoProperties(): void
    {
        // Создаём модель Test, у которой есть 'name'
        $testModel = \App\Models\Test::factory()->create();

        // Создаём DTO с полем name, совпадающим с атрибутом модели
        $dto = new FillFromModelTestDto();
        $dto = $dto->fillFromModel($testModel);

        // Проверяем, что DTO заполнен и name совпадает
        $this->assertInstanceOf(DefaultDto::class, $dto);
        $this->assertSame($testModel->name, $dto->name);
    }


    /**
     * Тест приведения типов в DTO
     * @see \Atlcom\LaravelHelper\Defaults\DefaultDto::casts()
     *
     * @return void
     */
    #[Test]
    public function castsMergesParentCasts(): void
    {
        $dto = new TestDto(['user_id' => 42]);

        // Проверяем, что свойство user_id корректно установлено
        $this->assertSame(42, $dto->user_id);
    }


    /**
     * Тест конвертации DTO в массив
     * @see \Atlcom\LaravelHelper\Defaults\DefaultDto::toArray()
     *
     * @return void
     */
    #[Test]
    public function dtoToArrayReturnsCorrectData(): void
    {
        $dto = new TestDto(['user_id' => 99]);

        $array = $dto->toArray();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('user_id', $array);
        $this->assertSame(99, $array['user_id']);
    }


    /**
     * Тест правил валидации DTO
     * @see \Atlcom\LaravelHelper\Defaults\DefaultDto::rules()
     *
     * @return void
     */
    #[Test]
    public function rulesReturnsArray(): void
    {
        $dto = new TestDto();

        $rules = $dto->rules();

        $this->assertIsArray($rules);
    }
}
