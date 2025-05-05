<?php

namespace App\Exceptions;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


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
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
         // Handle ModelNotFoundException (e.g., when a resource is not found)
         if ($exception instanceof ModelNotFoundException && $request->expectsJson()) {
            return response()->json([
                'message' => 'The requested resource was not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        // Handle NotFoundHttpException (e.g., when a route is not defined)
        if ($exception instanceof NotFoundHttpException && $request->expectsJson()) {
            return response()->json([
                'message' => 'The requested URL was not found.',
            ], Response::HTTP_NOT_FOUND);
        }
         // Handle other exceptions for JSON responses
         if ($request->expectsJson()) {
            return response()->json([
                'message' => $exception->getMessage() ?: 'Server Error',
                'details' => config('app.debug') ? $exception->getTrace() : null,
            ], $this->isHttpException($exception) ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        

        // Fallback to the parent handler for non-API requests
        return parent::render($request, $exception);

    }




}
