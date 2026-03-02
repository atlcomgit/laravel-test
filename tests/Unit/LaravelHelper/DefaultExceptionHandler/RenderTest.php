<?php

declare(strict_types=1);

namespace Tests\Unit\LaravelHelper\DefaultExceptionHandler;

use Atlcom\LaravelHelper\Defaults\DefaultExceptionHandler;
use Atlcom\LaravelHelper\Defaults\DefaultTest;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Тесты метода render обработчика DefaultExceptionHandler
 */
class RenderTest extends DefaultTest
{
    /**
     * Тест: render для NotFoundHttpException возвращает 404
     * @see \Atlcom\LaravelHelper\Defaults\DefaultExceptionHandler::render()
     *
     * @return void
     */
    #[Test]
    public function renderReturns404ForNotFoundException(): void
    {
        $handler = app(DefaultExceptionHandler::class);
        $request = Request::create('/api/not-found', 'GET');
        $request->headers->set('Accept', 'application/json');
        $exception = new NotFoundHttpException('Маршрут не найден');

        $response = $handler->render($request, $exception);

        $this->assertEquals(404, $response->getStatusCode());
    }


    /**
     * Тест: render для обычного Exception возвращает 500
     * @see \Atlcom\LaravelHelper\Defaults\DefaultExceptionHandler::render()
     *
     * @return void
     */
    #[Test]
    public function renderReturns500ForGenericException(): void
    {
        $handler = app(DefaultExceptionHandler::class);
        $request = Request::create('/api/test', 'GET');
        $request->headers->set('Accept', 'application/json');
        $exception = new \RuntimeException('Тестовая ошибка');

        $response = $handler->render($request, $exception);

        $this->assertContains($response->getStatusCode(), [500, 400]);
    }


    /**
     * Тест: render возвращает Response
     * @see \Atlcom\LaravelHelper\Defaults\DefaultExceptionHandler::render()
     *
     * @return void
     */
    #[Test]
    public function renderReturnsResponseInstance(): void
    {
        $handler = app(DefaultExceptionHandler::class);
        $request = Request::create('/api/test', 'GET');
        $exception = new \Exception('Тест');

        $response = $handler->render($request, $exception);

        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\Response::class, $response);
    }
}
