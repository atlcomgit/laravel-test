<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\DefaultModel;

use App\Models\Test as TestModel;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты статических методов DefaultModel через модель Test
 */
class GetTableNameTest extends DefaultTest
{
    /**
     * Тест получения имени таблицы через getTableName
     * @see \Atlcom\LaravelHelper\Traits\ModelTrait::getTableName()
     *
     * @return void
     */
    #[Test]
    public function getTableNameReturnsString(): void
    {
        $tableName = TestModel::getTableName();

        $this->assertIsString($tableName);
        $this->assertSame('tests', $tableName);
    }


    /**
     * Тест получения имени первичного ключа
     * @see \Atlcom\LaravelHelper\Traits\ModelTrait::getPrimaryKeyName()
     *
     * @return void
     */
    #[Test]
    public function getPrimaryKeyNameReturnsId(): void
    {
        $primaryKeyName = TestModel::getPrimaryKeyName();

        $this->assertIsString($primaryKeyName);
        $this->assertSame('id', $primaryKeyName);
    }


    /**
     * Тест получения типа первичного ключа
     * @see \Atlcom\LaravelHelper\Traits\ModelTrait::getPrimaryKeyType()
     *
     * @return void
     */
    #[Test]
    public function getPrimaryKeyTypeReturnsInt(): void
    {
        $primaryKeyType = TestModel::getPrimaryKeyType();

        $this->assertIsString($primaryKeyType);
        $this->assertSame('int', $primaryKeyType);
    }


    /**
     * Тест получения кастов модели
     * @see \Atlcom\LaravelHelper\Traits\ModelTrait::getModelCasts()
     *
     * @return void
     */
    #[Test]
    public function getModelCastsReturnsArray(): void
    {
        $casts = TestModel::getModelCasts();

        $this->assertIsArray($casts);
        $this->assertArrayHasKey('name', $casts);
    }


    /**
     * Тест получения ключей модели
     * @see \Atlcom\LaravelHelper\Traits\ModelTrait::getModelKeys()
     *
     * @return void
     */
    #[Test]
    public function getModelKeysReturnsArray(): void
    {
        $keys = TestModel::getModelKeys();

        $this->assertIsArray($keys);
    }
}
