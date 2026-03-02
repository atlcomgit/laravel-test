<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\CollectionMacros;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты макросов Collection (toArrayRecursive)
 */
class ToArrayRecursiveTest extends DefaultTest
{
    /**
     * Тест макроса toArrayRecursive на коллекции
     * @see \Atlcom\LaravelHelper\Services\CollectionMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function toArrayRecursiveConvertsNestedCollections(): void
    {
        $collection = new Collection([
            'key1'   => 'value1',
            'nested' => new Collection([
                'key2' => 'value2',
            ]),
        ]);

        $result = $collection->toArrayRecursive();

        $this->assertIsArray($result);
        $this->assertSame('value1', $result['key1']);
        $this->assertIsArray($result['nested']);
        $this->assertSame('value2', $result['nested']['key2']);
    }


    /**
     * Тест макроса toArrayRecursive на пустой коллекции
     * @see \Atlcom\LaravelHelper\Services\CollectionMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function toArrayRecursiveOnEmptyCollection(): void
    {
        $collection = new Collection();

        $result = $collection->toArrayRecursive();

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}
