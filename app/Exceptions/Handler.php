<?php 
namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Log the exception for debugging
        if ($request->expectsJson()) {
            \Log::error('API Exception: ' . get_class($exception) . ' - ' . $exception->getMessage());
        }

           // Catch validation exceptions and return 422 with proper format
    if ($exception instanceof ValidationException) {
        return response()->json([
            'code'=>422,
            'message' => 'Validation failed',
            'errors' => $exception->errors(),
        ], 422);
    }

        // Handle AuthenticationException
        if ($exception instanceof AuthenticationException && $request->expectsJson()) {
            return response()->json([
                'code'=>401,
                'message' => 'Unauthenticated.',
                'error' => 'Token is missing, invalid, or expired.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Handle ModelNotFoundException
        if ($exception instanceof ModelNotFoundException && $request->expectsJson()) {
            return response()->json([
                
                'message' => 'The requested resource was not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        // Handle NotFoundHttpException
        if ($exception instanceof NotFoundHttpException && $request->expectsJson()) {
            return response()->json([
                'message' => 'The requested URL was not found.',
            ], Response::HTTP_NOT_FOUND);
        }

        // Handle other exceptions
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $exception->getMessage() ?: 'Server Error',
                'details' => config('app.debug') ? $exception->getTrace() : null,
            ], $this->isHttpException($exception) ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Unauthenticated.',
                'error' => 'Token is missing, invalid, or expired.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return redirect()->guest(route('login'));
    }
}