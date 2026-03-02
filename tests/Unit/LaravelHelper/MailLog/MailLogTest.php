<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\MailLog;

use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Atlcom\LaravelHelper\Models\MailLog;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты модуля MailLog — логирование отправки писем
 */
class MailLogTest extends DefaultTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        Config::set('laravel-helper.mail_log.enabled', true);
        MailLog::query()->truncate();
    }


    /**
     * Тест что модель MailLog доступна и таблица существует
     * @see \Atlcom\LaravelHelper\Models\MailLog
     *
     * @return void
     */
    #[Test]
    public function mailLogTableExists(): void
    {
        $count = MailLog::query()->count();

        $this->assertSame(0, $count);
    }


    /**
     * Тест что таблица MailLog имеет корректное имя
     * @see \Atlcom\LaravelHelper\Models\MailLog::getTableName()
     *
     * @return void
     */
    #[Test]
    public function mailLogTableNameIsCorrect(): void
    {
        $tableName = MailLog::getTableName();

        $this->assertIsString($tableName);
        $this->assertStringContainsString('mail_logs', $tableName);
    }
}
