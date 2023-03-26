<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->_customizeErrorMethodNotAllowed();
        $this->_customizeErrorNotFound();

    }

    private function _customizeErrorMethodNotAllowed()
    {
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(__('validation.errors.404'), JsonResponse::HTTP_METHOD_NOT_ALLOWED);
            }
        });
    }

    private function _customizeErrorNotFound()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(__('validation.errors.404'), JsonResponse::HTTP_NOT_FOUND);
            }
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException || $exception instanceof NotFoundHttpException) {
            return response()->view('web.errors.' . '404', [], 404);
        } elseif ($exception instanceof TokenMismatchException) {
            return response()->view('web.errors.' . '419', [], 419);
        }

        return parent::render($request, $exception);
    }
}
