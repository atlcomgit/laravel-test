<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\ConnectionFactory;

use Atlcom\LaravelHelper\Databases\Connections\ConnectionFactory;
use Atlcom\LaravelHelper\Databases\Connections\MySqlConnection;
use Atlcom\LaravelHelper\Databases\Connections\PostgresConnection;
use Atlcom\LaravelHelper\Databases\Connections\SQLiteConnection;
use Atlcom\LaravelHelper\Databases\Connections\SqlServerConnection;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use PHPUnit\Framework\Attributes\Test;
use ReflectionMethod;

/**
 * Тесты метода createConnection фабрики ConnectionFactory
 */
class CreateConnectionTest extends DefaultTest
{
    private ConnectionFactory $factory;

    /** @var ReflectionMethod */
    private ReflectionMethod $method;


    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = new ConnectionFactory(app());
        $this->method = new ReflectionMethod(ConnectionFactory::class, 'createConnection');
    }


    /**
     * Тест: драйвер pgsql создаёт PostgresConnection
     * @see \Atlcom\LaravelHelper\Databases\Connections\ConnectionFactory::createConnection()
     *
     * @return void
     */
    #[Test]
    public function createConnectionReturnsPgsqlConnection(): void
    {
        $pdo = new \PDO('sqlite::memory:');

        $connection = $this->method->invoke(
            $this->factory,
            'pgsql',
            $pdo,
            'test_db',
            '',
            [],
        );

        $this->assertInstanceOf(PostgresConnection::class, $connection);
    }


    /**
     * Тест: драйвер mysql создаёт MySqlConnection
     * @see \Atlcom\LaravelHelper\Databases\Connections\ConnectionFactory::createConnection()
     *
     * @return void
     */
    #[Test]
    public function createConnectionReturnsMysqlConnection(): void
    {
        $pdo = new \PDO('sqlite::memory:');

        $connection = $this->method->invoke(
            $this->factory,
            'mysql',
            $pdo,
            'test_db',
            '',
            [],
        );

        $this->assertInstanceOf(MySqlConnection::class, $connection);
    }


    /**
     * Тест: драйвер sqlite создаёт SQLiteConnection
     * @see \Atlcom\LaravelHelper\Databases\Connections\ConnectionFactory::createConnection()
     *
     * @return void
     */
    #[Test]
    public function createConnectionReturnsSqliteConnection(): void
    {
        $pdo = new \PDO('sqlite::memory:');

        $connection = $this->method->invoke(
            $this->factory,
            'sqlite',
            $pdo,
            'test_db',
            '',
            [],
        );

        $this->assertInstanceOf(SQLiteConnection::class, $connection);
    }


    /**
     * Тест: драйвер sqlserver создаёт SqlServerConnection
     * @see \Atlcom\LaravelHelper\Databases\Connections\ConnectionFactory::createConnection()
     *
     * @return void
     */
    #[Test]
    public function createConnectionReturnsSqlServerConnection(): void
    {
        $pdo = new \PDO('sqlite::memory:');

        $connection = $this->method->invoke(
            $this->factory,
            'sqlserver',
            $pdo,
            'test_db',
            '',
            [],
        );

        $this->assertInstanceOf(SqlServerConnection::class, $connection);
    }
}
