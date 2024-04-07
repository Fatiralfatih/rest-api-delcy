<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof AuthenticationException) {
                return response()->json(['status' => 'failed', 'message' => 'silahkan login terlebih dahulu'], 401);
            } else if ($exception instanceof ValidationException) {
                $errors = [];
                foreach ($exception->errors() as $field => $messages) {
                    $errors[$field] = $messages[0];
                }
                return response()->json(['status' => 'failed', 'message' => 'Validation errors', 'errors' => $errors], 422);
            }
        }
        return parent::render($request, $exception);
    }
}
