<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\DefaultException;

use Atlcom\LaravelHelper\Defaults\DefaultException;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;

/**
 * Конкретный наследник DefaultException для тестирования
 */
class TestableException extends DefaultException
{
    public const CODE = 400;
    public const MESSAGE = 'Непредвиденная ошибка';
}

/**
 * Тесты класса DefaultException
 */
class ExceptTest extends DefaultTest
{
    /**
     * Тест выброса исключения через статический метод except
     * @see \Atlcom\LaravelHelper\Defaults\DefaultException::except()
     *
     * @return void
     */
    #[Test]
    public function exceptThrowsException(): void
    {
        $this->expectException(TestableException::class);
        $this->expectExceptionMessage('Тестовая ошибка');
        $this->expectExceptionCode(422);

        TestableException::except('Тестовая ошибка', 422);
    }


    /**
     * Тест исключения с дефолтными параметрами
     * @see \Atlcom\LaravelHelper\Defaults\DefaultException::except()
     *
     * @return void
     */
    #[Test]
    public function exceptThrowsWithDefaults(): void
    {
        $this->expectException(TestableException::class);
        $this->expectExceptionMessage(TestableException::MESSAGE);
        // except() без аргументов передаёт code=0 (по сигнатуре метода)
        $this->expectExceptionCode(0);

        TestableException::except();
    }


    /**
     * Тест создания исключения через конструктор
     * @see \Atlcom\LaravelHelper\Defaults\DefaultException::__construct()
     *
     * @return void
     */
    #[Test]
    public function constructorSetsMessageAndCode(): void
    {
        $exception = new TestableException('Тест', 500);

        $this->assertSame('Тест', $exception->getMessage());
        $this->assertSame(500, $exception->getCode());
    }


    /**
     * Тест значений констант по умолчанию
     * @see \Atlcom\LaravelHelper\Defaults\DefaultException
     *
     * @return void
     */
    #[Test]
    public function defaultConstantsAreCorrect(): void
    {
        $this->assertSame(400, DefaultException::CODE);
        $this->assertSame('Непредвиденная ошибка', DefaultException::MESSAGE);
    }
}
