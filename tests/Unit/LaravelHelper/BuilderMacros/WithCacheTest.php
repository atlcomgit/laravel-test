<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\BuilderMacros;

use App\Models\Test as TestModel;
use Atlcom\LaravelHelper\Databases\Builders\EloquentBuilder;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;

/**
 * Тесты макросов Builder (withCache, withLog, withModelLog)
 */
class WithCacheTest extends DefaultTest
{
    /**
     * Тест макроса withQueryLog на EloquentBuilder
     * @see \Atlcom\LaravelHelper\Services\BuilderMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function withQueryLogReturnsBuilder(): void
    {
        $builder = TestModel::withQueryLog();

        $this->assertInstanceOf(EloquentBuilder::class, $builder);
    }


    /**
     * Тест макроса withQueryCache на EloquentBuilder
     * @see \Atlcom\LaravelHelper\Services\BuilderMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function withQueryCacheReturnsBuilder(): void
    {
        $builder = TestModel::withQueryCache();

        $this->assertInstanceOf(EloquentBuilder::class, $builder);
    }


    /**
     * Тест макроса withModelLog на EloquentBuilder
     * @see \Atlcom\LaravelHelper\Services\BuilderMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function withModelLogReturnsBuilder(): void
    {
        $builder = TestModel::withModelLog();

        $this->assertInstanceOf(EloquentBuilder::class, $builder);
    }


    /**
     * Тест цепочки макросов withQueryCache + withQueryLog
     * @see \Atlcom\LaravelHelper\Services\BuilderMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function chainingMacrosWorks(): void
    {
        $builder = TestModel::withQueryCache()->withQueryLog();

        $this->assertInstanceOf(EloquentBuilder::class, $builder);
    }


    /**
     * Тест макроса withQueryLog на QueryBuilder (DB::table)
     * @see \Atlcom\LaravelHelper\Services\BuilderMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function withQueryLogOnQueryBuilderWorks(): void
    {
        $builder = DB::table('tests')->withQueryLog();

        $this->assertNotNull($builder);
    }


    /**
     * Тест макроса withQueryCache на QueryBuilder (DB::table)
     * @see \Atlcom\LaravelHelper\Services\BuilderMacrosService::register()
     *
     * @return void
     */
    #[Test]
    public function withQueryCacheOnQueryBuilderWorks(): void
    {
        $builder = DB::table('tests')->withQueryCache();

        $this->assertNotNull($builder);
    }
}
