<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param  Exception|Throwable  $e
     * @return Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render(
        $request,
        Exception|Throwable $e
    ): Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response {
        if ($request->expectsJson()) {
            return $this->response($e);
        }

        return parent::render($request, $e);
    }

    /**
     * @param  Exception  $exception
     * @return JsonResponse
     */
    protected function response(Exception $exception): JsonResponse
    {
        $statusCode = $this->getStatusCode($exception);

        return new JsonResponse([
            'status' => false,
            'message' => $exception->getMessage(),
        ], $statusCode);
    }

    /**
     * @param  Exception  $exception
     * @return int
     */
    protected function getStatusCode(Exception $exception): int
    {
        return method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
    }
}
